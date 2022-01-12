<?php

namespace Tests\Browser;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Auth;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class PostsBrowserTest extends DuskTestCase
{
    use WithoutMiddleware;
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

//    public function test_create_post()
//    {
//        $user = User::factory()->create();
//
//        Auth::login($user);
//
//        $this->browse(function (Browser $browser) use ($user) {
//            $browser->loginAs($user->id)->visit('/posts')
//                ->assertVisible('#new_post')
//                ->visit(
//                    $browser->attribute('#new_post', 'href')
//                )
//                ->type('title', 'Dusk Test Post')
//                ->type('body', 'Body of Dusk test post')
//                ->press('CreatePostButton')
//                ->assertRouteIs('posts.personal');
//        });
//        $this->assertDatabaseHas('posts', [
//            'title' => 'Dusk Test Post',
//            'body' => 'Body of Dusk test post',
//        ]);
//    }
//
//    public function test_update_post() {
//        $user = User::factory()->create();
//
//        Auth::login($user);
//
//        $this->browse(function (Browser $browser) {
//            $browser->visit('/posts')
//                ->type('title', 'Dusk Updated Test Post')
//                ->type('body', 'Body of Updated Dusk test post')
//                ->press('UpdatePostButton')
//                ->assertRouteIs('posts.personal');
//        });
//        $this->assertDatabaseHas('posts', [
//            'title' => 'Dusk Test Post',
//            'body' => 'Body of Dusk test post',
//        ]);
//    }

// no such element: Unable to locate element: {"method":"css selector","selector":"body title"}
}
