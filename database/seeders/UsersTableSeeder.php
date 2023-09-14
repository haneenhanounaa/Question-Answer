<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::query()->create([
            'name'=>'Haneen',
            'email'=>'ha@gmail.com',
            'mobile'=>'0590000000',
            'password'=>Hash::make('ha@gmail.com'),
        ]);
    }
}
