<?php

namespace Database\Factories;

use App\Models\Forum;
use Illuminate\Database\Eloquent\Factories\Factory;

class ForumFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Forum::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 10),
            'name' => $name = $this->faker->streetName,
            'slug' => str_replace(' ', '-', preg_replace('#[[:punct:]]#', '', strtolower($name))),
            'description' => $this->faker->sentence,
            'active' => $this->faker->numberBetween(0,1)
        ];
    }
}
