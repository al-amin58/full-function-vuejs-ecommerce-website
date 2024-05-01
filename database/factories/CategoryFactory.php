<?php

namespace Database\Factories;

use App\Models\category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = category::class;
    public function definition(): array
    {
        return [
            'name'          => $this->faker->unique()->word(),
            'image'         => $this->faker->imageUrl('200', '120'),
            'created_at'    => now(),
            'updated_at'    => now(),
        ];
    }
}
