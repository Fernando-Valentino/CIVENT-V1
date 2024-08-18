<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

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
            [
                'name' => 'Admin',
                'nim' => '-',
                'email' => 'admin@gmail.com',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('admin'),
                'role' => 'admin',
                'remember_token' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'User',
                'nim' => '12345678901',
                'email' => 'user@gmailcom',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('user'),
                'role' => 'user',
                'remember_token' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

    }

    

    
}
