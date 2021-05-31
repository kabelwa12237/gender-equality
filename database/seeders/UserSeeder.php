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
        //
        $user1 = User::create([
            'name' => 'libe',
            'email' => 'libedawson@gmail.com',
            'password' => Hash::make('1234')
        ]);

        $user1->roles()->attach(Role::find(1));

        $user2 = User::create([
            'name' => 'vicky',
            'email' => 'vickylukumay@gmail.com',
            'password' => Hash::make('1234')
        ]);

        $user2->roles()->attach(Role::find(2));


        $user3 = User::create([
            'name' => 'elly',
            'email' => 'ellydawson@gmail.com',
            'password' => Hash::make('1234')
        ]);
        $user3->roles()->attach(Role::find(3));

        $user4 = User::create([
            'name' => 'elli',
            'email' => 'ellidawson@gmail.com',
            'password' => Hash::make('1234')
        ]);
        $user4->roles()->attach(Role::find(3));
    }
}
