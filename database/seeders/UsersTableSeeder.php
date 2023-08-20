<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name'=>'Haneen',
            'email'=>'ha@gmail.com',
            'password'=>Hash::make('ha@gmail.com'),
            'created_at'=>now(),
            'updated_at'=>now()
        ]);
        //
    }
}
