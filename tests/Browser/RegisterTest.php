<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RegisterTest extends DuskTestCase
{
    use WithoutMiddleware;
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function test_can_user_register_on_browser()
    {
        $user = User::factory()->make();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit(route('register'))
                ->type('name', $user->name)
                ->type('email', $user->email)
                ->type('password', 'password')
                ->type('password_confirmation', 'password')
                ->press('register')
                ->assertSee('Google Authenticator')
                ->press('Complete Registration')
                ->assertPathIs('/dashboard');
        });
    }



}
