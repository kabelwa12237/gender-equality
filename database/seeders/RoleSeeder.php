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
        //
        Role::create([
            'name'=>'Admin',
            'description'=>'this is Admin',
        ]);

        Role::create([
            'name'=>'Author',
            'description'=>'this is Author',
        ]);

        Role::create([
            'name'=>'Auditor',
            'description'=>'this is Auditor',
        ]);
    }
}
