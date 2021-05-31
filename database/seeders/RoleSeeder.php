<?php

namespace Database\Seeders;

use App\Models\Role;
use Hamcrest\Description;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Role::create(['name'=>'system admin', 'description'=>'system administrator']);
        Role::create(['name'=>'author', 'description'=>'author']);
        Role::create(['name'=>'normal user', 'description'=>'normal user']);
    }
}
