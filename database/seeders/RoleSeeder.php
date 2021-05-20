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
            'description' => 'Database Administrator',

        ]);
        Role::create([
            'name' => 'Nertwoker',
            'description' => 'Network Administrator',

        ]);

        Role::create([
            'name' => 'analyst',
            'description' => 'Database Administrator',

        ]);
    }
}
