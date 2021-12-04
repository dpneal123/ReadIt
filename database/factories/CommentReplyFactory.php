<?php

namespace Database\Factories;

use App\Models\CommentReply;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentReplyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CommentReply::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'comment_id' => $this->faker->numberBetween(1,1000),
            'user_id' => $this->faker->numberBetween(1,10),
            'reply' => $this->faker->sentence
        ];
    }
}
