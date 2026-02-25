<?php

use App\Models\User;

it('registers a new user', function () {
    // When visiting the registration page
    visit('/register')
    // And filling out the form with valid data
        ->fill('name', 'John Doe')
        ->fill('email', 'john@mail.pt')
        ->fill('password', 'password')
        // And submitting the form
        ->press('@register-button')
        // And redirected to the homepage /ideas
        ->assertPathIs('/ideas');

    // Then the user should be registered
    expect(User::count())->toBe(1);
    expect(User::where('email', 'john@mail.pt')->exists())->toBeTrue();

    // And logged in
    $this->assertAuthenticated();
});
