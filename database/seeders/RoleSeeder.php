<?php

namespace Database\Seeders;

use App\Models\Role;
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
        Role::create([
            'name'=>'Author',
            'description'=>'permission to write and read'
           ]);

        Role::create([
            'name'=>'Editor',
            'description'=>'permission to write and read and edit'
           ]);
        Role::create([
            'name'=>'Administrator',
            'description'=>'This is the system administrator'
           ]);
        Role::create([
            'name'=>'User',
            'description'=>'permission to write and read and comment'
           ]);
        
    }
}
