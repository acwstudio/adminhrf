<?php

namespace Database\Factories;

use App\Models\Like;
use Illuminate\Database\Eloquent\Factories\Factory;

class LikeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Like::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $models = [
            'App\Models\News',
            'App\Models\Article',
            'App\Models\Comment',
            '...'
        ];
        return [
            'likeable_id' => $this->faker->unique()->numberBetween(1,10),
            'likeable_type' => $models[rand(0,2)],
            'user_id' => $this->faker->unique()->numberBetween(1,10),
        ];
    }
}
