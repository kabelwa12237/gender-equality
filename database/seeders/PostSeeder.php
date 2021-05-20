<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use PhpParser\Node\Expr\PostDec;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::factory()->count(100)->create();
    }
}
