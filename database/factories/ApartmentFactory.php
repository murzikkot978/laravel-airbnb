<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Apartment>
 */
class ApartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
                'title' => fake()->sentence(),
                'content' => fake()->paragraph(),
                'rooms' => fake()->randomDigit(),
                'peoples' => fake()->randomDigit(),
                'price' => fake()->randomDigit(),
                'photo' => fake()->imageUrl(),
                'country' => fake()->country(),
                'city' => fake()->city(),
                'street' => fake()->streetAddress(),
        ];
    }
}
