<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 100; $i++) {
            Comment::create([
                'post_id' => fake()->numberBetween(1, 100),
                'user_id' => fake()->numberBetween(1, 2),
                'content' => fake()->text(20),
                'parent_id' => fake()->optional(0.5, null)->numberBetween(0, 100)
            ]);
        }
    }
}