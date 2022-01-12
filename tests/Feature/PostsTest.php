<?php

namespace Tests\Feature;

use App\Http\Livewire\Vote;
use App\Models\Forum;
use App\Models\Post;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Auth;
use Livewire\Livewire;
use PragmaRX\Google2FA\Google2FA;
use Tests\TestCase;

class PostsTest extends TestCase
{
    use WithoutMiddleware;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_load_posts_page()
    {
        $response = $this->get('/posts');

        $response->assertSee('Posts');
    }

    public function test_load_posts_show_page()
    {
        $post = Post::factory()->create();

        $response = $this->get('/posts/'.$post->id);

        $response->assertSee($post->title);
    }

    public function test_can_user_create_new_post() {
        $user = User::factory()->create();
        $forum = Forum::factory()->create();

        $user->save();
        $forum->save();

        Auth::login($user);

         $this->actingAs($user)->post('/posts', [
            'title' => 'test post',
            'body' => 'This is the description of a test post',
            'forum_id' => $forum->id,
            'user_id' => $user->id,
        ]);

        $this->assertDatabaseHas('posts', [
            'title' => 'test post',
            'body' => 'This is the description of a test post',
            'forum_id' => $forum->id,
            'user_id' => $user->id,
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

        $this->assertDatabaseHas('posts', [
            'title' => 'test post update',
            'body' => 'This is the description of an updated test post',
            'user_id' => $post->user_id,
            'forum_id' => $post->forum_id,
        ]);
    }

    public function test_can_user_update_other_users_posts() {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);

        $post->save();

        $newuser = User::factory()->create();

        $this->actingAs($newuser)->patch('posts/'.$post->id, [
            'title' => 'test post update',
            'body' => 'This is the description of an updated test post',
            'user_id' => $newuser->id,
            'forum_id' => $post->forum_id,
        ]);

        $this->assertDatabaseMissing('posts', [
            'title' => 'test post update',
            'body' => 'This is the description of an updated test post',
            'user_id' => $post->user_id,
            'forum_id' => $post->forum_id,
        ]);
    }

    public function test_can_user_delete_post() {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);

        $post->save();

        $this->actingAs($user)->delete('posts/'.$post->id);

        $this->assertDatabaseMissing('posts', [
            'title' => $post->title,
            'body' => $post->body,
            'user_id' => $post->user_id,
            'forum_id' => $post->forum_id,
        ]);
    }

    public function test_can_user_delete_other_users_post() {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);

        $post->save();

        $newuser = User::factory()->create();

        $this->actingAs($newuser)->delete('posts/'.$post->id);

        $this->assertDatabaseHas('posts', [
            'title' => $post->title,
            'body' => $post->body,
            'user_id' => $post->user_id,
            'forum_id' => $post->forum_id,
        ]);
    }

    public function test_can_user_upvote_post() : void {
        $user = User::factory()->create();
        $post = Post::factory()->create();

        Livewire::actingAs($user);
        Livewire::test(Vote::class)
            ->call('addVote', $post->id, $user->id, 1)
            ->assertSuccessful();

        $this->assertDatabaseHas('post_votes', [
            'user_id' => $user->id,
            'post_id' => $post->id,
            'isUp' => 1,
        ]);
    }

    public function test_can_user_downvote_post() : void {
        $user = User::factory()->create();
        $post = Post::factory()->create();

        Livewire::actingAs($user);
        Livewire::test(Vote::class)
            ->call('addVote', $post->id, $user->id, 0)
            ->assertSuccessful();

        $this->assertDatabaseHas('post_votes', [
            'user_id' => $user->id,
            'post_id' => $post->id,
            'isUp' => 0,
        ]);
    }
}
