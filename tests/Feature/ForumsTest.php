<?php

namespace Tests\Feature;

use App\Models\Forum;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ForumsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_load_forums_page()
    {
        $response = $this->get('/forums');

        $response->assertStatus(302);
    }

    public function test_load_forum_show_page()
    {
        $forum = Forum::factory()->create();

        $response = $this->get('/forums/'.$forum->id);

        $response->assertStatus(302);
    }

    public function test_can_user_create_new_forum() {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('forums', [
            'name' => 'test forum',
            'description' => 'This is the description of a test forum',
            'active' => '1',
        ]);

        $response->assertRedirect(route('forums.index'));
    }

    public function test_can_user_update_forum() {
        $user = User::factory()->create();
        $forum = Forum::factory()->create();

        $response = $this->actingAs($user)->patch('forums/'.$forum->id, [
            'name' => 'test forum',
            'description' => 'This is the description of a test forum',
            'active' => '1',
        ]);

        $response->assertStatus(200); // successful HTTP response
    }

    public function test_can_user_delete_forum() {
        $user = User::factory()->create();
        $post = Post::factory()->create();

        $response = $this->actingAs($user)->delete('forums/'.$post->id);

        $response->assertRedirect(route('forums.index'));
    }
}
