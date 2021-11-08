<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class PostsBrowserTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function test_load_posts_index()
    {
        $user = User::factory()->create();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit(route('login'))
                ->type('email', $user->email)
                ->type('password', 'password')
                ->press('login');
        });

        $this->browse(function (Browser $browser) {
            $browser->visit('/posts')
                    ->assertRouteIs('posts.index')
                    ->assertSee('Posts');
        });
    }

    public function test_create_post()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertVisible('#new_post')
                ->visit(
                    $browser->attribute('#new_post', 'href')
                )
                ->type('title', 'Dusk Test Post')
                ->type('body', 'Body of Dusk test post')
                ->press('CreatePostButton')
                ->assertRouteIs('posts.index');
        });
        $this->assertDatabaseHas('posts', [
            'title' => 'Dusk Test Post',
            'body' => 'Body of Dusk test post',
        ]);
    }
}
