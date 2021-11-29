<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Forum;
use App\Models\Post;
use App\Models\PostVote;
use App\Models\User;
use App\Models\UserForum;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create(['email' => 'admin@email.com']);
        User::factory(9)->create();
        Forum::factory(10)->create();
        Post::factory(100)->create();
        Comment::factory(1000)->create();
        PostVote::factory(1000)->create()->unique();
        UserForum::factory(5)->create()->unique();
    }
}
