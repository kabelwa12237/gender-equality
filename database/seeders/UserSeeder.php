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
            'name' => 'felician',
            'email' => 'felly@gmail.com',
            'password' =>Hash::make('felly123')
        ]);

        User::create([
            'name' => 'cecilia',
            'email' => 'cecy@gmail.com',
            'password' =>Hash::make('cecy1234')
        ]);

        User::create([
            'name' => 'queen',
            'email' => 'QBinagi@gmail.com',
            'password' =>Hash::make('queen12345')
        ]);
    }
}
