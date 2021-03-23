<?php

namespace Database\Factories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;

class AuthorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Author::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'firstname' => $this->faker->firstName,
            'surname' => $this->faker->firstName,
            'patronymic' => $this->faker->firstName,
            'birth_date' => $this->faker->date(),
            'announce' => $this->faker->sentence(),
            'description' => $this->faker->sentence(20),
            'created_at' => $this->faker->dateTimeBetween('-30 days', '-20 days'),
            'updated_at' => $this->faker->dateTimeBetween('-10 days', '-5 days'),
        ];
    }
}
