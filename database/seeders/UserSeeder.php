<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Tolibaev Niyazbek',
                'phone' => '+998907056963',
                'email' => 'niyazbek@gmail.com',
                'password' => Hash::make('123'),
                'is_premium' => true,
                'is_admin' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Musabek Makhambetjaliev',
                'phone' => '+998953555020',
                'email' => 'musa@gmail.com',
                'password' => Hash::make('123'),
                'is_premium' => true,
                'is_admin' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sabirbaev Batirbek',
                'phone' => '+998906503099',
                'email'=> 'batir@gmail.com',
                'password' => Hash::make('123'),
                'is_premium' => false,
                'is_admin' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        DB::table('users')->insert($users);
    }
}
