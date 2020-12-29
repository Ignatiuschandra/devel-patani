<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\UserModel;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker::create('id_ID');

        for ($i=0; $i < 15; $i++) { 
        	$user               = new UserModel();
	        $user->username     = strtolower($faker->firstName.time());
	        $user->password     = password_hash('123456', PASSWORD_DEFAULT);
	        $user->email        = $faker->postcode.$faker->email;
	        $user->no_hp        = str_replace(' ', '', str_replace('(', '', str_replace(')', '', $faker->phoneNumber)));
	        $user->nama         = $faker->name;
	        $user->alamat       = substr($faker->address, 0, 40);
	        $user->save();
        }
    }
}
