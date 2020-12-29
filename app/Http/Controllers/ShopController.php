<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductModel;
use App\Models\PembayaranModel;
use App\Models\TransaksiModel;
use Session;
use DB;

class ShopController extends Controller
{
    public function index(Request $request)
    {
    	$res = ProductModel::where('nama_produk', 'LIKE', "%$request->s%");

    	if (!is_null($request->c)) {
    		$res->where('jenis_produk', '=', "$request->c");
    	}

        return view('shop', [
        	'category' 	=> $request->c, 
        	'search' 	=> $request->s,
        	'result'	=> $res->get(),
        ]);
    }

    public function payment(Request $request)
    {
        $res = ProductModel::where('product_id', '=', $request->id)->first();

        return view('payment', ['res' => $res]);
    }

    public function purchase(Request $request)
    {
        try {
            //save pembayaran
            $pembayaran = new PembayaranModel;
            $pembayaran->nominal            = $request->price * $request->jumlah;
            $pembayaran->bank               = $request->bank;
            $pembayaran->jenis_pembayaran   = $request->jenis;
            $pembayaran->user_id            = Session::get('id');
            $pembayaran->status             = 'settlement';
            $pembayaran->save();

            //save transaksi
            $transaki = new TransaksiModel; 
            $transaki->user_id              = Session::get('id');
            $transaki->product_id           = $request->id;
            $transaki->jumlah_transaksi     = $request->jumlah;
            $transaki->id_pembayaran        = $pembayaran->id;
            $transaki->save();

            //decrease qty
            ProductModel::where('product_id', $request->id)
                ->update([
                    'jumlah' => DB::Raw("jumlah - $request->jumlah")
                ]);

            return redirect()->back()->with('status', 'Transaksi Sukses!');

        } catch (\Throwable $th) {
            return redirect()->back()->with('status', 'Transaksi GAGAL! '.$th->getMessage());            
        }
    }
}
