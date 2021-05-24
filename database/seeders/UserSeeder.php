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
        $user1=User::create([
            'name'=>'sophia',
            'email'=>'sophiamemba@gmail.com',
            'password'=>Hash::make('12345t'),
           
        ]);
       $user1->roles()->attach(Role::find(1));
       
        
        $user2=User::create([
            'name'=>'juma',
            'email'=>'jumabaraka@gmail.com',
            'password'=>Hash::make('6789t')
        ]);
        $user2->roles()->attach(Role::find(2));
       

        $user3=User::create([
            'name'=>'asha',
            'email'=>'ashabaraka@gmail.com',
            'password'=>Hash::make('12345t')
        ]);
        $user3->roles()->attach(Role::find(3));
        
    }
}
