<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RealEstateProperty>
 */
class RealEstatePropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(3, true),
			'real_estate_type' => $this->faker->randomElement(['House', 'Department', 'Land', 'Commercial_Ground']),
			'street' => $this->faker->address(),
			'external_number' => $this->faker->text(12),
			'internal_number' => $this->faker->text(12),
			'neighborhood' => $this->faker->text(128),
			'city' => $this->faker->city(),
			'country' => $this->faker->countryCode(),
			'rooms' => $this->faker->numberBetween(1, 5),
			'bathrooms' => $this->faker->numberBetween(1, 3),
			'comments' => $this->faker->text(128)
        ];
    }
}
