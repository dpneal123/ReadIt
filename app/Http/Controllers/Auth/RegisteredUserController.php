<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use PragmaRX\Google2FAQRCode\Google2FA;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $google2fa = app('pragmarx.google2fa');

        $registration_data = $request->all();

        $registration_data["google2fa_secret"] = $google2fa->generateSecretKey();

        $request->session()->flash('registration_data', $registration_data);

        $inlineUrl = $google2fa->getQRCodeInline(
            'ReadIt',
            $registration_data['email'],
            $registration_data['google2fa_secret'],
        );

        return view('auth.google-2fa', ['inlineURL' => $inlineUrl, 'secret' => $registration_data['google2fa_secret']]);
    }

    public function completeRegister(Request $request) {

        $registration_data = $request->session()->get('registration_data');

        $user = User::create([
            'name' => $registration_data['name'],
            'email' => $registration_data['email'],
            'password' => Hash::make($registration_data['password']),
            'google2fa_secret' => $registration_data['google2fa_secret'],
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('dashboard');
    }
}
