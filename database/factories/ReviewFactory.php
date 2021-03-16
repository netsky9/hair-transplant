<?php

namespace Database\Factories;

use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Review::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $text = $this->faker->text(rand(1000,2000));
        $createdAt = $this->faker->dateTimeBetween($startDate = '-30 days', $endDate = '-5 days', $timezone = null);

        return [
            'user_id' => 2, // simple users
            'clinica_id' => rand(1, 30),
            'text' => $text,
            'rating' => (rand(1, 3) != 1) ? 5 : rand(1, 4),
            'created_at'    => $createdAt,
            'updated_at'    => $createdAt,
        ];
    }
}
