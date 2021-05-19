<?php

namespace Database\Seeders;

use App\Models\Reactions;
use Illuminate\Database\Seeder;

class ReactionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Reactions::factory()->count(6)->create();
    }
}
