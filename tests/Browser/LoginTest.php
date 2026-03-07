<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;

it('logs in a user', function () {
    $user = User::factory()->create([
        'password' => 'pestBrowserTest',
    ]);

    visit('/login')
        ->type('email', $user->email)
        ->type('password', 'pestBrowserTest')
        ->click('#login-button')
        ->assertPathIs('/');

    $this->assertAuthenticated();
});

it('logs out a user', function () {
    $user = User::factory()->create();

    Auth::login($user);

    $this->assertAuthenticated();

    visit('/')
        ->click('@logout-button')
        ->assertPathIs('/');

    $this->assertGuest();
});
