<?php

namespace Database\Factories;

use App\Models\View;
use Illuminate\Database\Eloquent\Factories\Factory;

class ViewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = View::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $model = [
            'App\Models\Article',
            'App\Models\News',
        ];

        return [
            'total' => $this->faker->numberBetween(0,1000),
            'viewable_type' => $model[rand(0,1)],
            'viewable_id' =>$this->faker->unique()->numberBetween(1,10),
            'created_at' => $this->faker->dateTimeAd(),
            'updated_at' => $this->faker->dateTimeAd(),
        ];
    }
}
