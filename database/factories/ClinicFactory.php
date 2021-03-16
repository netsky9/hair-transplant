<?php

namespace Database\Factories;

use App\Models\Clinic;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ClinicFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Clinic::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence(rand(5,10));
        $excerpt = $this->faker->realText();
        $text = $this->faker->text(rand(1000,2000));
        $work_time = '0'.rand(7,9).':00 - '.rand(16,21).':00 Monday - Saturday';
        $phone = $this->faker->phoneNumber;
        $email = $this->faker->companyEmail;
        $address = $this->faker->address;
        $latitude = $this->faker->latitude($min = -90, $max = 90);
        $longitude = $this->faker->longitude($min = -180, $max = 180);
        $createdAt = $this->faker->dateTimeBetween($startDate = '-5 month', $endDate = '-4 month', $timezone = null);

        return [
            'user_id' => 1,
            'title' => $title,
            'slug' => Str::slug($title),
            'excerpt' => $excerpt,
            'text' => $text,
            'work_time' => $work_time,
            'phone' => $phone,
            'email' => $email,
            'address' => $address,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'created_at'    => $createdAt,
            'updated_at'    => $createdAt,
        ];
    }
}
