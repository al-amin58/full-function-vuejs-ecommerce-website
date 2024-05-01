<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Location;
use App\Models\Property;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
{
    protected $model = Property::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'       => function(){return User::inRandomOrder()->value('id');},
            'location_id'   => function(){return Location::inRandomOrder()->value('id');},
            'title'         => $this->faker->sentence(3, false),
            'slug'          => $this->faker->unique->slug(),
            'description'   => $this->faker->text,
            'price'         => $this->faker->randomFloat(2, 0, 1000),
            'type'          => $this->faker->randomElement(['home', 'apartment', 'plot']),
            'purpose'       => $this->faker->randomElement(['rent','sell']),
            'bed'           => $this->faker->numberBetween(2,8),
            'bath'          => $this->faker->numberBetween(1, 6),
            'area'          => $this->faker->numberBetween(500, 3000),
            'created_at'    =>now(),
            'updated_at'    => now(),
        ];
    }
}
