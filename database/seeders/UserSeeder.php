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
            'name' => 'Sara',
            'email' => 'lukumayyvictori@gmail.com',
            'password' =>   Hash::make('1234567890')
        ]);

        User::create([
            'name' => 'Izack',
            'email' => 'lukumayizack@gmail.com',
            'password' =>   Hash::make('1234567890')
        ]);

        User::create([
            'name' => 'lightness',
            'email' => 'lvictoria@gmail.com',
            'password' =>   Hash::make('1234567890')
        ]);
    }
}
