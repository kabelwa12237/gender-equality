<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name'=>'admin',
            'description'=>'admin',
        ]);
        Role::create([
            'name'=>'guest',
            'description'=>'guest',
        ]);
        Role::create([
            'name'=>'community',
            'description'=>'community',
        ]);
    }
}
