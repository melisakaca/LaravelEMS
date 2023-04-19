<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('users')->insert([
        //     'name' => 'User',
        //     'email' => 'user@nmc.al',
        //     'password' => bcrypt('Test123@'),
        //     'gender' =>'female',
        //     'role' => "user",
        //     'account_status'=> 1,
        //     'position' => 'developer',
        //     'joinDate' => '2000-01-01'
        // ]);


        // DB::table('users')->insert([
        //     'name' => 'User1',
        //     'email' => 'user1@nmc.al',
        //     'password' => bcrypt('Test123@'),
        //     'gender' =>'male',
        //     'role' => "user",
        //     'account_status'=> 1,
        //     'position' => 'developer',
        //     'joinDate' => '2000-01-01'
        // ]);

        // DB::table('users')->insert([
        //     'name' => 'User2',
        //     'email' => 'user2@nmc.al',
        //     'password' => bcrypt('Test123@'),
        //     'gender' =>'male',
        //     'role' => "user",
        //     'account_status'=> 1,
        //     'position' => 'developer',
        //     'joinDate' => '2000-01-01'
        // ]);

        DB::table('users')->insert([
            'name' => 'HR',
            'email' => 'hr@nmc.al',
            'password' => bcrypt('Test1234@'),
            'gender' =>'female',
            'role' => "admin",
            'account_status'=> 1,
            'position' => 'hr',
            'joinDate' => '2010-01-01'
        ]);
    }
}
