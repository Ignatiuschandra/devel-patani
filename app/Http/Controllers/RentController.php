<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PembayaranModel;
use App\Models\PenyewaanModel;
use DateTime;
use Session;

class RentController extends Controller
{
    public function index(Request $request)
    {
        $rent = array();

        if(Session::has('id')){
            $rent = PenyewaanModel::select('penyewaan.id_penyewaan as id', 'alat_disewa', 'tanggal_disewa', 'tanggal_dikembalikan', 'penyewaan.status', 'nama_penyedia', 'nominal', 'deskripsi')
                    ->join('penyedia', 'penyedia.id_penyedia', '=', 'penyewaan.id_penyedia')
                    ->join('pembayaran', 'pembayaran.id_pembayaran', '=', 'penyewaan.id_pembayaran')
                    ->where('penyewaan.user_id', Session::get('id'))
                        ->get();
        }

        return view('rent', [ 
        	'rent' 	=> $rent,
        ]);
    }

    public function do_rent(Request $request)
    {
    	try {
    		$date1 = new DateTime($request->tgl_awal);
    		$date2 = new DateTime($request->tgl_akhir);

    		$pembayaran = new PembayaranModel;
    		$pembayaran->user_id 	= Session::get('id');
    		$pembayaran->status 	= 'pending';
    		$pembayaran->save();

    		$penyewaan = new PenyewaanModel;
	    	$penyewaan->alat_disewa 			= $request->alat;
	    	$penyewaan->tanggal_disewa 			= $request->tgl_awal;
	    	$penyewaan->tanggal_dikembalikan 	= $request->tgl_akhir;
	    	$penyewaan->lama_disewa 			= $date1->diff($date2)->days;
	    	$penyewaan->id_pembayaran 			= $pembayaran->id;
	    	$penyewaan->user_id 				= Session::get('id');
	    	$penyewaan->status 					= 'diajukan';
	    	$penyewaan->save();	

	    	return redirect()->back()->with('status', "Berhasil mengajukan permohonan. ");
    	} catch (\Throwable $th) {
    		return redirect()->back()->with('status', "GAGAL mengajukan permohonan. ".$th->getMessage());
    	}

    }

    public function purchase(Request $request)
    {
        try {
            // Ubah status peminjaman dan pembayaran
            PenyewaanModel::where('id_penyewaan', $request->id)
                ->join('pembayaran', 'pembayaran.id_pembayaran', '=', 'penyewaan.id_pembayaran')
                ->update([
                    'penyewaan.status' => 'dibayar',
                    'pembayaran.status' => 'settlement',
                    'bank'              => $request->bank,
                    'jenis_pembayaran'  => $request->jenis,
                ]);

            return redirect()->back()->with('status', 'Transaksi Sukses!');

        } catch (\Throwable $th) {
            return redirect()->back()->with('status', 'Transaksi GAGAL! '.$th->getMessage());            
        }
    }
}
