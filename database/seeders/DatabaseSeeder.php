<?php

namespace Database\Seeders;
 
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'user_name' => "TestUser",
            'email' => 'TestUser@gmail.com',
            'password' => Hash::make('password'),
        ]);

        DB::table('users')->insert([
            'user_name' => "TestUser2",
            'email' => 'TestUser2@gmail.com',
            'password' => Hash::make('password2'),
        ]);
        
        // DB::table('notes')->insert([
        //     'user_name' => "TestUser2",
        //     'completed' => false,
        //     'password' => Hash::make('password2'),
        // ]);
    }
}
