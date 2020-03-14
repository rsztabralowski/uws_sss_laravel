<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use App\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
    * @param  $provider
    * @return \Illuminate\Http\Response
    */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
    * @param  $provider
    * @return \Illuminate\Http\Response
    */
    public function handleProviderCallback($provider)
    {
        $socialiteUser = Socialite::driver($provider)->user();

        // Find or create user based on provider response
        $user = $this->firstOrCreateUser($socialiteUser, $provider);

        // Login user
        Auth::login($user);

        // Redirect user to intended path
        return redirect()->intended($this->redirectPath());
    }

    /**
    * @param  $socialiteUser
    * @param  $provider
    * @return \App\User
    */
    protected function firstOrCreateUser($socialiteUser, $provider)
    {
        if ($user = User::where("{$provider}_id", $socialiteUser->getId())->first()) {
            return $user;
        }

        if (!is_null($socialiteUser->getEmail()) && $user = User::where('email', $socialiteUser->getEmail())->first()) {
            $user->update(["{$provider}_id" => $socialiteUser->getId()]);

            return $user;
        }

        return User::create([
            "{$provider}_id" => $socialiteUser->getId(),
            'email' => $socialiteUser->getEmail(),
            'name' => $socialiteUser->getName(),
        ]);
    }
}
