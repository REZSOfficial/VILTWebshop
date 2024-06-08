<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $brands = ['Adidas', 'Puma', 'Reebok', 'Vans', 'Under Armour', 'New Balance'];
        return [
            'name' => $this->faker->randomElement($brands),
        ];
    }
}
