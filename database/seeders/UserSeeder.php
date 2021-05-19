<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create(['name'=>'libe', 'email'=>'libedawson@gmail.com','password'=>Hash::make('1234')]);
        User::create(['name'=>'vicky', 'email'=>'vickylukumay@gmail.com','password'=>Hash::make('1234')]);
        User::create(['name'=>'elly', 'email'=>'ellydawson@gmail.com','password'=>Hash::make('1234')]);
    }
}
