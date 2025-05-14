<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(mt_rand(2, 8)),
            'slug' => $this->faker->slug(),
            'excerpt' => $this->faker->paragraph(),
            // menjoin kan tag p dimana setiap array akan di bungkus oleh tag p
            // 'body' => '<p>' . implode('</p><p>',$this->faker->paragraph(mt_rand(5, 10))). '</p>',
            'body' => collect($this->faker->paragraphs(mt_rand(5, 10))) //merubah aray jadi collection
                ->map(function ($p) { //map untuk maping
                    return "<p>$p</p>";
                })
                ->implode(''), //menjoinkan tag p
            'user_id' => mt_rand(1, 3),
            'category_id' => mt_rand(1, 3)
        ];
    }
}
