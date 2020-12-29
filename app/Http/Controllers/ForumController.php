<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ForumModel;
use App\Models\ForumIsiModel;
use App\Models\UserModel;
use DateTime;
use Session;
use DB;

class ForumController extends Controller
{
    public function forum(){
    	$forum = ForumIsiModel::select('id_forum', 'nama_forum', 'kategori_forum', DB::Raw('MAX(forum_isi.created_at) as created_at'))
    				->join('forum', 'forum_isi.forum_id', '=', 'forum.id_forum')
		    		->orderBy('forum_isi.created_at', 'DESC')
		    		->groupBy('forum.id_forum')
		    		->get();

		foreach ($forum as $key => $value) {
			$forum[$key]->time_elapsed = $this->time_elapsed_string($value->created_at);
		}

        return view('forum', ['forum' => $forum]);
    }

    public function create(Request $request)
    {
    	try {
    		$nama = UserModel::where('user_id', Session::get('id'))
		    			->value('nama');
    		$forum 					= new ForumModel;
        	$forum->kategori_forum 	= $request->kategori;
        	$forum->nama_forum 		= $request->nama;
        	$forum->id_admin 		= 1;
        	$forum->user_id 		= Session::get('id');
        	$forum->pembuat_forum 	= $nama;
        	$forum->pengaturan 		= '';
        	$forum->save();

        	return redirect('forum/topic/'.$forum->id);
    	} catch (\Throwable $th) {
    		return redirect()->back()->with('status', 'Gagal membuat topic! '.$th->getMessage());
    	}
    }

    public function topic(Request $request){
    	$forum = ForumModel::where('id_forum', $request->id)
    					->first();

    	$isi = ForumIsiModel::join('user', 'user.user_id', '=', 'forum_isi.user_id')
    					->where('forum_id', $request->id)
    					->orderBy('forum_isi.created_at')
    					->get();

        return view('forum-replies', ['forum' => $forum, 'isi' => $isi]);
    }

    public function reply(Request $request)
    {
    	try {
    		$forumIsi = new ForumIsiModel;
	    	$forumIsi->forum_id 	= $request->f_id;
	    	$forumIsi->user_id 		= Session::get('id');
	    	$forumIsi->isi 			= $request->reply;
	    	$forumIsi->save();	

	    	return redirect("/forum/topic/$request->f_id#last");
    	} catch (\Throwable $th) {
    		return redirect()->back()->with('status', 'Gagal membalas topic! '.$th->getMessage());
    	}
    }

    function time_elapsed_string($datetime, $full = false) {
	    $now = new DateTime;
	    $ago = new DateTime($datetime);
	    $diff = $now->diff($ago);

	    $diff->w = floor($diff->d / 7);
	    $diff->d -= $diff->w * 7;

	    $string = array(
	        'y' => 'year',
	        'm' => 'month',
	        'w' => 'week',
	        'd' => 'day',
	        'h' => 'hour',
	        'i' => 'minute',
	        's' => 'second',
	    );
	    foreach ($string as $k => &$v) {
	        if ($diff->$k) {
	            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
	        } else {
	            unset($string[$k]);
	        }
	    }

	    if (!$full) $string = array_slice($string, 0, 1);
	    return $string ? implode(', ', $string) . ' ago' : 'just now';
	}
}
