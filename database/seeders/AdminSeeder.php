<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AdminModel;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user               = new AdminModel();
        $user->username     = 'admin';
        $user->password     = password_hash('123456', PASSWORD_DEFAULT);
        $user->email        = 'admin@patani.co.id';
        $user->no_hp        = '0812345678901';
        $user->nama         = 'Admin Patani';
        $user->alamat       = 'Indonesia';
        $user->save();
    }
}
