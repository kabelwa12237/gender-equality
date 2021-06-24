<?php

namespace Database\Factories;

use App\Models\Report;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        return [
            'body'=> $this->faker->text(),
            'media_type'=>$this->faker->randomElement(["audio", "video", "image", "text"]),
            'latitude'=> $this->faker->latitude(),
            'longitude'=> $this->faker->longitude()

        ];
    }
}
