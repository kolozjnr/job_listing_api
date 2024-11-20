<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
            'id' => Str::uuid()->toString(),
            'fname' => Str::random(10),
            'lname' => Str::random(10),
            'email' => 'dev@gmail.com',
            'tel' => '+23470000000000',
            'company_name' => Str::random(10),
            'user_type' => 'admin',
            'state' => Str::random(10),
            'address' => 'Abuja NG',
            'password' => Hash::make('dev@123'),
        ]);
    }
}
