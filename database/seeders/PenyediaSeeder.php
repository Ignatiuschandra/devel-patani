<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\PenyediaModel;

class PenyediaSeeder extends Seeder
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
        	$supplier               	= new PenyediaModel();
	        $supplier->nama_penyedia    = $faker->name;
	        $supplier->email_penyedia   = $faker->postcode.$faker->email;
	        $supplier->no_hp_penyedia   = str_replace(' ', '', str_replace('(', '', str_replace(')', '', $faker->phoneNumber)));
	        $supplier->alamat_penyedia  = substr($faker->address, 0, 40);
	        $supplier->save();
        }
    }
}
