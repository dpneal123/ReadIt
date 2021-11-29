<?php

namespace Tests\Feature;

use App\Models\Forum;
use App\Models\Post;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class PostsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_load_posts_page()
    {
        $response = $this->get('/posts');

        $response->assertStatus(302);
    }

    public function test_load_posts_show_page()
    {
        $post = Post::factory()->create();

        $response = $this->get('/posts/'.$post->id);

        $response->assertStatus(302);
    }

    public function test_can_user_create_new_post() {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->post('/posts', [
            'title' => 'test post',
            'body' => 'This is the description of a test post',
            'forum_id' => $post->forum_id,
            'user_id' => $post->user_id,
        ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('posts', [
            'title' => 'test post',
            'body' => 'This is the description of a test post',
            'forum_id' => $post->forum_id,
            'user_id' => $post->user_id,
        ]);
    }

    public function test_can_user_update_post() {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->patch('posts/'.$post->id, [
            'title' => 'test post update',
            'body' => 'This is the description of an updated test post',
            'user_id' => $post->user_id,
            'forum_id' => $post->forum_id,
        ]);

        $response->assertSuccessful();

        $this->assertDatabaseHas('posts', [
            'title' => 'test post update',
            'body' => 'This is the description of an updated test post',
            'user_id' => $post->user_id,
            'forum_id' => $post->forum_id,
        ]);
    }

    public function test_can_user_delete_post() {
        $user = User::factory()->create();
        $post = Post::factory()->create();

        $response = $this->actingAs($user)->delete('posts/'.$post->id);

        $this->assertDatabaseMissing('posts', [
            'title' => $post->title,
            'body' => $post->body,
            'user_id' => $post->user_id,
            'forum_id' => $post->forum_id,
        ]);
    }
}
