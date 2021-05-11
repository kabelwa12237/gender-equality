<?php

namespace Database\Factories;

use App\Models\Organization;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrganizationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Organization::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->company(),
            'type'=>$this->faker->randomElement(["IT","police","usaid","div"]),
            'contact'=>$this->faker->phoneNumber(),
            'latitude'=>$this->faker->latitude(),
            'longitude'=>$this->faker->longitude(),
            'address'=>$this->faker->address(),
            
        ];
    }
}
