<?php

use function Pest\Laravel\assertDatabaseHas;

it('registers a user', function () {
    visit('/register')
        ->type('name', 'John Doe')
        ->type('email', 'johndoe@example.com')
        ->type('password', 'password123')
        ->click('#register-button')
        ->assertPathIs('/');

    $this->assertAuthenticated();

    assertDatabaseHas('users', [
        'name' => 'John Doe',
        'email' => 'johndoe@example.com',
    ]);
});

it('requires name email and password to register', function () {
    visit('/register')
        ->click('#register-button')
        ->assertPathIs('/register')
        ->assertSee('The name field is required.')
        ->assertSee('The email field is required.')
        ->assertSee('The password field is required.');
});

it('requires a valid email to register', function () {
    visit('/register')
        ->type('name', 'John Doe')
        ->type('email', 'not-a-valid-email')
        ->type('password', 'password123')
        ->click('#register-button')
        ->assertPathIs('/register');
});
