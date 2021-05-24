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
            'name' => 'Admin',
            'description' => 'system expert',
        ]);

        Role::create([
            'name' => 'User',
            'description' => 'system expert',
        ]);

        Role::create([
            'name' => 'Guest ',
            'description' => 'system expert',
        ]);

        // Role::factory()->count(3)->create();
    }
    }

