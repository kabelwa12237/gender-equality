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
        $user1 = User::create([
            'name' => 'eliza',
            'email' => 'eliza@gmail.com',
            'password' => Hash::make('eliza')
        ]);
        $user1->roles()->attach(Role::find(1));
        
        $user2 = User::create([
            'name' => 'liza',
            'email' => 'liza@gmail.com',
            'password' => Hash::make('liza')
        ]);
        $user2->roles()->attach(Role::find(2));

          $user3 = User::create([
            'name' => 'liz',
            'email' => 'liz@gmail.com',
            'password' => Hash::make('liz')
        ]);
        $user3->roles()->attach(Role::find(3));

        $user4 = User::create([
            'name' => 'elizaa',
            'email' => 'elizaa@gmail.com',
            'password' => Hash::make('elizaa')
        ]);
        $user4->roles()->attach(Role::find(4));

    }
}
