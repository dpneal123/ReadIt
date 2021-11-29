<?php

namespace Database\Factories;

use App\Models\UserForum;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserForumFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserForum::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'forum_id' => $this->faker->numberBetween(1, 10),
            'user_id' => $this->faker->numberBetween(2,10),
        ];
    }
}
