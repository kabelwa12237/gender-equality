<?php

namespace Database\Seeders;

use App\Models\Role;
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
        
       $user = User::create([
            'name'=>'chichi',
            'email'=>'c@gmail.com',
            'password'=>Hash::make('chichi')
        ]);
        $user->roles()->attach(Role::find(1));

       $user2= User::create([
            'name'=>'sarah',
            'email'=>'s@gmail.com',
            'password'=>Hash::make('sarah')
        ]);
        $user2->roles()->attach(Role::find(2));

        $user3=User::create([
            'name'=>'karista',
            'email'=>'k@gmail.com',
            'password'=>Hash::make('karista')
        ]);
        $user3->roles()->attach(Role::find(3));

    }
}
