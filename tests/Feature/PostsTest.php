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

    public function test_load_post_show_page()
    {
        $post = Post::factory()->create();

        $response = $this->get('/posts/'.$post->id);

        $response->assertStatus(302);
    }

    public function test_can_user_create_new_post() {
        $user = User::factory()->create();
        $forum = Forum::factory()->create();


        $response = $this->actingAs($user)->post('posts', [
            'title' => 'test post',
            'body' => 'This is the body of a test post',
            'forum_id' => $forum->id,
        ]);

        $response->assertRedirect('posts');
    }

    public function test_can_user_update_post() {
        $user = User::factory()->create();
        $forum = Forum::factory()->create();
        $post = Post::factory()->create();

        $response = $this->actingAs($user)->patch('posts/'.$post->id, [
            'title' => 'updated test post',
            'body' => 'This is the body of a test post',
            'forum_id' => $forum->id,
        ]);

        $response->assertStatus(200); // successful HTTP response
    }

    public function test_can_user_delete_post() {
        $user = User::factory()->create();
        $post = Post::factory()->create();

        $response = $this->actingAs($user)->delete('posts/'.$post->id);

        $response->assertRedirect(route('posts.index'));
    }
}
