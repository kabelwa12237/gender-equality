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
            'name'=>'sophia',
            'email'=>'sophiamemba@gmail.com',
            'password'=>Hash::make('12345t')
        ]);
        User::create([
            'name'=>'juma',
            'email'=>'jumabaraka@gmail.com',
            'password'=>Hash::make('6789t')
        ]);
        User::create([
            'name'=>'asha',
            'email'=>'ashabaraka@gmail.com',
            'password'=>Hash::make('12345t')
        ]);
    }
}
