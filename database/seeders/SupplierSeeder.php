<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\SupplierModel;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        for ($i=0; $i < 10; $i++) { 
        	$supplier               	= new SupplierModel();
	        $supplier->nama_supplier    = $faker->name;
	        $supplier->email_supplier   = $faker->postcode.$faker->email;
	        $supplier->no_hp_supplier   = str_replace(' ', '', str_replace('(', '', str_replace(')', '', $faker->phoneNumber)));
	        $supplier->alamat_supplier  = substr($faker->address, 0, 40);
	        $supplier->save();
        }
    }
}
