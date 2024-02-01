<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use App\Models\User;

class LoginController extends Controller
{
    public function redirectToGoogle()
    {
        $state = Str::random(40);
        session(['google_state' => $state]);

        $query = http_build_query([
            'client_id' => config('services.google.client_id'),
            'redirect_uri' => config('services.google.redirect'),
            'response_type' => 'code',
            'scope' => 'openid profile email',
            'state' => $state,
        ]);

        return redirect('https://accounts.google.com/o/oauth2/auth?' . $query);
    }

    public function handleGoogleCallback()
    {
        $state = request('state');
        abort_if(
            !$state || $state !== session('google_state'),
            403,
            'Invalid state parameter'
        );

        $response = Http::asForm()->post('https://accounts.google.com/o/oauth2/token', [
            'code' => request('code'),
            'client_id' => config('services.google.client_id'),
            'client_secret' => config('services.google.client_secret'),
            'redirect_uri' => config('services.google.redirect'),
            'grant_type' => 'authorization_code',
        ]);

        $accessToken = $response->json()['access_token'];

        $userInfo = Http::get('https://www.googleapis.com/oauth2/v1/userinfo', [
            'access_token' => $accessToken,
        ])->json();

        // Your logic to create or login the user
        // For example:
        $existingUser = User::where('email', $userInfo['email'])->first();
        if ($existingUser) {
            auth()->login($existingUser);
        } else {
            // Create a new user record in your database
            $newUser = User::create([
                'name' => $userInfo['name'],
                'email' => $userInfo['email'],
                'password' => bcrypt(Str::random(16)),
            ]);
            auth()->login($newUser);
        }

        return redirect('/profile');
    }

    public function logout()
{
    auth()->logout();
    return redirect('/');
}

}