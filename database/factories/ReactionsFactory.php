<?php

namespace Database\Factories;

use App\Models\Reactions;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReactionsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reactions::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'reaction_type' => $this->faker->randomElement(['smile', 'sad']),
            'reaction_emoj' => $this->faker->emoji(),
        ];
    }
}
