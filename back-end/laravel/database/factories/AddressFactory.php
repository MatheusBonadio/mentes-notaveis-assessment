<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement(['Home', 'Work', 'School', 'Other']),
            'street' => $this->faker->streetAddress(),
            'city_id' => City::all()->random()->id,
            'user_id' => User::all()->random()->id
        ];
    }
}
