<?php

namespace Database\Factories;

use App\Models\Image;
use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{

    protected $model = Image::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'url'           => $this->faker->imageUrl(400, 200),
            'property_id'    => function(){return Property::inRandomOrder()->value('id');},
            'created_at'    => now(),
            'updated_at'    => now(),
        ];
    }
}
