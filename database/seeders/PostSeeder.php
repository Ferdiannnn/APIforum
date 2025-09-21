<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Support\Str;
use Ramsey\Uuid\Type\Integer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        for ($i = 0; $i < 100; $i++) {
            Post::create([
                'user_id' => fake()->numberBetween(1, 2),
                'title' => fake()->realText(maxNbChars: 20),
                'content' => fake()->text()
            ]);
        }
    }
}