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
            'user_id'=>$this->faker->randomDigit(),
            'reactionable_id'=>$this->faker->randomDigit(),
            'reactionable_type'=>$this->faker->randomElement(["comment","post"]),
            'type'=>$this->faker->randomElement(["laughing","cry","sneez"]), 
            'emoji'=>$this->faker->emoji(),
        ];
    }
}
