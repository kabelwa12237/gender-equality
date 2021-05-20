<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Organization;
use App\Models\Report;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
       // \App\Models\Organization::factory()->count(100)->create();
       $this->call(OrganizationSeeder::class);
       $this->call(ReportSeeder::class);
       $this->call(UserSeeder::class);
       $this->call(PostSeeder::class);
       $this->call(CommentSeeder::class);
       $this->call(ReactionSeeder::class);
    }
}
