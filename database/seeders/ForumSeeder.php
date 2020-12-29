<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ForumModel;
use App\Models\UserModel;
use Faker\Factory as Faker;

class ForumSeeder extends Seeder
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
        	$user = UserModel::inRandomOrder()->first();

        	$forum 					= new ForumModel;
        	$forum->kategori_forum 	= $faker->sentence($nbWords = 1, $variableNbWords = true);
        	$forum->nama_forum 		= $faker->sentence($nbWords = 3, $variableNbWords = true);
        	$forum->id_admin 		= 1;
        	$forum->user_id 		= $user->user_id;
        	$forum->pembuat_forum 	= $user->nama;
        	$forum->pengaturan 		= '';
        	$forum->save();
        }
    }
}
