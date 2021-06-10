<?php

namespace Database\Factories;

use App\Models\Reaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'emoji' => $this->faker->emoji(),
            'type' => $this->faker->randomElement(["Sad", "Happy", "laughing"]),
            'user_id' => $this->faker->randomDigit(),
            'reactionable_id' => $this->faker->randomDigit(),
            'reactionable_type' => $this->faker->randomElement(["post", "comment"]),
        ];
    }
}
