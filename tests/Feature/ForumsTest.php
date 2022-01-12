<?php

namespace Tests\Feature;

use App\Http\Livewire\Vote;
use App\Models\Forum;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Auth;
use Livewire\Livewire;
use PragmaRX\Google2FALaravel\Google2FA;
use PragmaRX\Google2FALaravel\Tests\Google2FaLaravelTest;
use Tests\TestCase;

class ForumsTest extends TestCase
{
    use WithoutMiddleware;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_load_forums_page()
    {
        $response = $this->get('/forums');

        $response->assertSee('Forums');
    }

    public function test_load_forum_show_page()
    {
        $forum = Forum::factory()->create();

        $response = $this->get('/forums/'.$forum->id);

        $response->assertSee($forum->name);
    }

    public function test_can_user_create_new_forum() {
        $user = User::factory()->create();

        $user->save();

        Auth::login($user);

        $response = $this->actingAs($user)->post('forums', [
            'name' => 'test forum',
            'description' => 'This is the description of a test forum',
            'active' => '1',
        ]);

        $this->assertDatabaseHas('forums', [
            'name' => 'test forum',
            'description' => 'This is the description of a test forum',
            'active' => '1',
        ]);
    }

    public function test_can_user_update_forum() {
        $user = User::factory()->create();

        Auth::login($user);

        $forum = Forum::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->patch('forums/'.$forum->id, [
            'name' => 'test forum update',
            'description' => 'description of an updated test forum',
            'active' => 1,
        ]);

        $this->assertDatabaseHas('forums', [
            'name' => 'test forum update',
            'description' => 'description of an updated test forum',
            'active' => 1,
        ]);
    }

    public function test_can_user_update_other_users_forum() {
        $user = User::factory()->create();

        Auth::login($user);

        $forum = Forum::factory()->create(['user_id' => $user->id]);

        $forum->save();

        $newuser = User::factory()->create();

        $this->actingAs($newuser)->patch('forums/'.$forum->id, [
            'name' => 'test forum update',
            'description' => 'description of an updated test forum',
            'active' => 1,
            'user_id' => $user->id,
        ]);

        $this->assertDatabaseMissing('forums', [
            'name' => 'test forum update',
            'description' => 'description of an updated test forum',
            'active' => 1,
            'user_id' => $user->id
        ]);
        $this->assertDatabaseHas('forums', [
            'name' => $forum->name,
            'description' => $forum->description,
            'active' => $forum->active,
            'user_id' => $forum->user_id,
        ]);

    }

    public function test_can_user_delete_forum() {
        $user = User::factory()->create();
        $forum = Forum::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->delete('forums/'.$forum->id);

        $this->assertDatabaseMissing('forums', [
            'name' => $forum->name,
            'description' => $forum->description,
        ]);
    }

    public function test_can_user_delete_other_users_forum() {
        $user = User::factory()->create();
        $forum = Forum::factory()->create(['user_id' => $user->id]);

        $newuser = User::factory()->create();

        $response = $this->actingAs($newuser)->delete('forums/'.$forum->id);

        $this->assertDatabaseHas('forums', [
            'name' => $forum->name,
            'description' => $forum->description,
            'active' => $forum->active,
        ]);
    }

    public function test_can_user_join_forum() {
        $user = User::factory()->create();
        $forum = Forum::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user)->post('/forums/'. $forum->id .'/join');

        $this->assertDatabaseHas('user_forums', [
            'forum_id' => $forum->id,
            'user_id' => $user->id,
        ]);
    }

    public function test_can_user_remove_forum() {
        $user = User::factory()->create();
        $forum = Forum::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user)->post('/forums/'. $forum->id .'/remove');

        $this->assertDatabaseMissing('user_forums', [
            'forum_id' => $forum->id,
            'user_id' => $user->id,
        ]);
    }
}
