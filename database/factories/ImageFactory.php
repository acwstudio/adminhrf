<?php

namespace Database\Factories;

use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Image::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'path' => $this->faker->url,
            'name' => $this->faker->word,
            'ext' => 'jpg',
            'alt' => $this->faker->words(3, true),
            'order' => 3,
            'imageable_id' => null,
            'imageable_type' => null,
            'flags' => 1,
        ];
    }
}
