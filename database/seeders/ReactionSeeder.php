<?php

namespace Database\Seeders;

use App\Models\Reaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 100; $i++) {
            Reaction::create([
                'user_id' => fake()->numberBetween(1, 2),
                'post_id' => fake()->numberBetween(1, 100),
                'type' => fake()->randomElement(['like', 'dislike'])
            ]);
        }
    }
}