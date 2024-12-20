<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Administrator',
            'email' => 'admin@gymbarbar.com', 
            'email_verified_at' => now(), 
            'password' => bcrypt('12345678'), 
            'remember_token' => Str::random(10), 
            'role' => 'ADMINISTRATOR', 
            'plain_token' => '',
        ]); 
        DB::table('users')->insert([
            'name' => 'Terminal 1',
            'email' => 'terminal1@gymbarbar.com', 
            'email_verified_at' => now(), 
            'password' => bcrypt('12345678'), 
            'remember_token' => Str::random(10), 
            'role' => 'TERMINAL',
            'plain_token' => '',
        ]);
    }
}


// login admin ke-1 (uji-coba)
// 1|oXIr59fkiUtB3wvXbnEiKsgZUvdrCwCArDnoF3Sq2c4e8085

// login admin ke-2
// 3|rQNPbGH44c0gNWZPsq4P4pmc3rZe1st0eDnaDBqk298a16c4

// register admin baru-1
// {
//     "name" : "irfan",
//     "email" : "irfan123@gymbarbar.com",
//     "password" : "12345678", 
//     "password_confirmation": "12345678"
// }

// register terminal ke-1 (dari sisi admin)
// {
//     "name" : "gibran",
//     "email" : "gibran@gymbarbar"
// }
// 2|A3e7wOYF1peG0vgL8t30xuQKJmiJ05M43E108NIsa6bed9c4

// register terminal ke-2 (dari sisi admin)
// {
//     "name" : "budi",
//     "email" : "budi@gymbarbar.com"
// }
// 4|mBT8QAChVlqgkWFUcJj390Qifyto77y55dwcxqYSa8ff8da8


