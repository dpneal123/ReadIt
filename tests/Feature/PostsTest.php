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

        $this->assertDatabaseHas('forums', [
            'name' => 'test forum',
            'description' => 'This is the description of a test forum',
            'active' => '1',
        ]);
    }

    public function test_can_user_update_forum() {
        $user = User::factory()->create();
        $forum = Forum::factory()->create();

        $response = $this->actingAs($user)->patch('forums/'.$forum->id, [
            'name' => 'test forum update',
            'description' => 'description of an updated test forum',
            'active' => 1,
        ]);

        $response->assertRedirect(route('forums.index'));

        $this->assertDatabaseHas('forums', [
            'name' => 'test forum update',
            'description' => 'description of an updated test forum',
            'active' => 1,
        ]);
    }

    public function test_can_user_delete_forum() {
        $user = User::factory()->create();
        $forum = Forum::factory()->create();

        $response = $this->actingAs($user)->delete('forums/'.$forum->id);

        $response->assertRedirect(route('forums.index'));

        $this->assertDatabaseMissing('forums', [
            'name' => $forum->title,
            'description' => $forum->description,
            'active' => $forum->active,
        ]);
    }
}
