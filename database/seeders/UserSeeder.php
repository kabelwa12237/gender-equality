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
        
       $user= User::create([
            'name' => 'felician',
            'email' => 'felly@gmail.com',
            'password' =>Hash::make('felly123')
        ]);

$user->roles()->attach(Role::find(1));

$user1=User::create([
            'name' => 'cecilia',
            'email' => 'cecy@gmail.com',
            'password' =>Hash::make('cecy1234')
        ]);

        $user1->roles()->attach(Role::find(2));

        $user2=User::create([
            'name' => 'queen',
            'email' => 'QBinagi@gmail.com',
            'password' =>Hash::make('queen12345')
        ]);
        
$user2->roles()->attach(Role::find(3));
    }
}
