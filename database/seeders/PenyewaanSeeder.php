<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PenyewaanModel;
use App\Models\PembayaranModel;
use App\Models\UserModel;
use Faker\Factory as Faker;
use DateTime;

class PenyewaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$alat = ['Cangkul', 'Traktor', 'Sabit', 'Sekop', 'Beliung'];
        for ($i=0; $i < 100; $i++) { 
        	$rand = mt_rand(0,4);
        	
        	$date1 = new DateTime(date('Y-m-d'));
    		$date2 = new DateTime(date('Y-m-d', strtotime("+$rand day")));

    		$pembayaran = new PembayaranModel;
    		$pembayaran->user_id 	= UserModel::inRandomOrder()->value('user_id');
    		$pembayaran->status 	= 'pending';
    		$pembayaran->save();

    		$penyewaan = new PenyewaanModel;
	    	$penyewaan->alat_disewa 			= $alat[$rand++];
	    	$penyewaan->tanggal_disewa 			= $date1;
	    	$penyewaan->tanggal_dikembalikan 	= $date2;
	    	$penyewaan->lama_disewa 			= $date1->diff($date2)->days;
	    	$penyewaan->id_pembayaran 			= $pembayaran->id;
	    	$penyewaan->user_id 				= $pembayaran->user_id;
	    	$penyewaan->status 					= 'diajukan';
	    	$penyewaan->save();	
        }
    }
}
