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
        
        User::create([
            'name'=>'chichi',
            'email'=>'c@gmail.com',
            'password'=>Hash::make('chichi')
        ]);

        User::create([
            'name'=>'sarah',
            'email'=>'s@gmail.com',
            'password'=>Hash::make('sarah')
        ]);

        User::create([
            'name'=>'karista',
            'email'=>'k@gmail.com',
            'password'=>Hash::make('karista')
        ]);

    }
}
