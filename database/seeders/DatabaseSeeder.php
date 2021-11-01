<?php

namespace Database\Seeders;

use App\Models\Forum;
use App\Models\Post;
use App\Models\User;
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
    }
}
