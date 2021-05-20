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

        $user =      User::create([
            'name' => 'Sara',
            'email' => 'lukumayyvictori@gmail.com',
            'password' =>   Hash::make('1234567890')
        ]);
        

        $user->roles()->attach(Role::find(1));

        $user1 =  User::create([
            'name' => 'Izack',
            'email' => 'lukumayizack@gmail.com',
            'password' =>   Hash::make('1234567890')
        ]);
        $user1->roles()->attach(Role::find(2));

        $user2 =   User::create([
            'name' => 'lightness',
            'email' => 'lvictoria@gmail.com',
            'password' =>   Hash::make('1234567890')
        ]);

        $user2->roles()->attach(Role::find(3));
    }
}
