<?php

namespace Database\Factories;

use App\Models\Report;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ReportFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Report::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence(rand(5,10));
        $text = $this->faker->text(rand(1000,2000));
        $excerpt = $this->faker->realText();
        $createdAt = $this->faker->dateTimeBetween($startDate = '-4 month', $endDate = '-2 month', $timezone = null);

        return [
            'user_id' => rand(3, 20),
            'clinica_id' => rand(1, 30),
            'title' => $title,
            'slug' => Str::slug($title),
            'excerpt' => $excerpt,
            'text' => $text,
            'created_at' => $createdAt,
            'updated_at' => $createdAt
        ];
    }
}
