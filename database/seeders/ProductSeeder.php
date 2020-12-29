<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\ProductModel;
use App\Models\SupplierModel;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        $jenis = 'Buah Segar';
        for ($i=0; $i < 75; $i++) { 
        	$jenis = $jenis == 'Buah Segar' ? 'Perlengkapan Pertanian' : 'Buah Segar';
        	$product               		= new ProductModel();
	        $product->nama_produk    	= $faker->sentence($nbWords = 2, $variableNbWords = true);
	        $product->jenis_produk   	= $jenis;
	        $product->jumlah   			= $faker->numberBetween($min = 5, $max = 100);
	        $product->harga  			= $faker->numberBetween($min = 5000, $max = 100000);
	        $product->deskripsi			= $faker->sentence($nbWords = 10, $variableNbWords = true);
	        $product->supplier_id		= SupplierModel::inRandomOrder()->value('supplier_id');
	        $product->save();
        }
    }
}
