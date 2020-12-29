<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PenyewaanModel;
use App\Models\PenyediaModel;
use Session;

class AdminController extends Controller
{
    public function index()
    {
    	$penyedia 	= PenyediaModel::get();
    	$pengajuan 	= PenyewaanModel::select('penyewaan.id_penyewaan as id', 'alat_disewa', 'tanggal_disewa', 'tanggal_dikembalikan', 'pembayaran.status as status_pembayaran', 'penyewaan.status as status_penyewaan', 'user.nama')
    					->join('pembayaran', 'pembayaran.id_pembayaran', 'penyewaan.id_pembayaran')
    					->join('user', 'user.user_id', 'penyewaan.user_id')
    					->where('penyewaan.status', 'diajukan')
    					->orWhere('penyewaan.status', 'dibayar')
    					->orWhere('penyewaan.status', 'dipinjam')
    					->get();

    	return view('admin.pengajuan-rental', ['rent' => $pengajuan, 'supplier' => $penyedia]);
    }

    public function set_status(Request $request){
    	try {
    		PenyewaanModel::where('id_penyewaan', $request->id)
	    		->update([
	    			'id_admin'	=> Session::get('id'),
	    			'status'	=> $request->status,
	    		]);

	    	return redirect()->back()->with('status', 'Berhasil memperbaharui status!');	
    	} catch (\Throwable $th) {
    		return redirect()->back()->with('status', 'GAGAL memperbaharui status! '.$th->getMessage());	
    	}
    }

    public function approved(Request $request){
    	try {
    		PenyewaanModel::join('pembayaran', 'pembayaran.id_pembayaran', 'penyewaan.id_pembayaran')
    			->where('id_penyewaan', $request->id)
	    		->update([
	    			'id_admin'			=> Session::get('id'),
	    			'nominal'			=> $request->biaya,
	    			'id_penyedia'		=> $request->penyedia,
	    			'deskripsi'			=> $request->deskripsi,
	    			'penyewaan.status'	=> 'diterima',
	    		]);

	    	return redirect()->back()->with('status', 'Berhasil memperbaharui status!');	
    	} catch (\Throwable $th) {
    		return redirect()->back()->with('status', 'GAGAL memperbaharui status! '.$th->getMessage());	
    	}
    }
}
