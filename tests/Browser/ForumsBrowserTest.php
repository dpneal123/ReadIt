<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Auth;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ForumsBrowserTest extends DuskTestCase
{
    use WithoutMiddleware;
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function test_load_forums_index()
    {
        $user = User::factory()->create();

        Auth::login($user);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit(route('login'))
                ->type('email', $user->email)
                ->type('password', 'password')
                ->press('login');
        });

        $this->browse(function (Browser $browser) {
            $browser->visit('/forums')
                ->assertRouteIs('forums.index')
                ->assertSee('Forums');
        });
    }

//    public function test_create_forum()
//    {
//        $user = User::factory()->create();
//
//        Auth::login($user);
//
//        $this->browse(function (Browser $browser) use ($user) {
//            $browser->loginAs($user->id)->visit('/forums')
//                ->assertVisible('#new_forum')
//                ->visit(
//                    $browser->attribute('#new_forum', 'href')
//                )
//                ->type('name', 'Dusk Test forum')
//                ->type('description', 'Body of Dusk test forum')
//                ->press('CreateForumButton')
//                ->assertRouteIs('forums.personal');
//        });
//        $this->assertDatabaseHas('forums', [
//            'name' => 'Dusk Test forum',
//            'description' => 'Body of Dusk test forum',
//        ]);
//    }
//
//    public function test_update_forum() {
//        $user = User::factory()->create();
//
//        Auth::login($user);
//
//        $this->browse(function (Browser $browser) {
//            $browser->visit('/forums')
//                ->type('name', 'Dusk Updated Test forum')
//                ->type('body', 'Body of Updated Dusk test forum')
//                ->press('UpdateForumButton')
//                ->assertRouteIs('forums.index');
//        });
//        $this->assertDatabaseHas('forums', [
//            'name' => 'Dusk Test forum',
//            'description' => 'Body of Dusk test forum',
//        ]);
//    }
}
