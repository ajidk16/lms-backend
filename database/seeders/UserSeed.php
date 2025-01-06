<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'admin',
                'role' => 'admin',
                'email' => 'admin@gmail.com',
                'phone' => 85157711650,
                'address' => 'puri matahari persada laladon',
                'password' => Hash::make('bismillah'),
            ],
            [
                'name' => 'customer',
                'role' => 'customer',
                'email' => 'customer@gmail.com',
                'phone' => 85157711650,
                'address' => 'puri matahari persada laladon',
                'password' => Hash::make('bismillah'),
            ],
    ]);
    }
}
