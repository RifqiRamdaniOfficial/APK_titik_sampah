<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Req>
 */
class ReqFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "user_id"=>mt_rand(1,3),
            "region_id"=>mt_rand(1,15),
            'addres' => $this->faker->address(),
            'slug' => $this->faker->slug(),
            'information' => $this->faker->paragraph(),
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
            'publish_at' => $this->faker->dateTimeThisYear(),
        ];
    }
}
