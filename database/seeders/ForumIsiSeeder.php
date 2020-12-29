<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ForumModel;
use App\Models\ForumIsiModel;
use App\Models\UserModel;
use Faker\Factory as Faker;

class ForumIsiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        for ($i=0; $i < 100; $i++) { 
        	$forumIsi 				= new ForumIsiModel;
        	$forumIsi->forum_id 	= ForumModel::inRandomOrder()->value('id_forum');
        	$forumIsi->user_id 		= UserModel::inRandomOrder()->value('user_id');
        	$forumIsi->isi 			= $faker->sentence($nbWords = 10, $variableNbWords = true);
        	$forumIsi->save();
        }
    }
}
