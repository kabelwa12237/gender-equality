<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(OrganizationSeeder::class);
        $this->call(ReportSeeder::class);
        $this->call(CommentSeeder::class);
        $this->call(PostSeeder::class);
        $this->call(ReactionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);


    }
}
