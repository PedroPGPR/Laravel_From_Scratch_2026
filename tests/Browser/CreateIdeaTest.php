<?php

use App\Models\Idea;
use App\Models\User;

it('can create a idea', function (): never {
    $this->actingAs($user = User::factory()->create());

    visit('/ideas')
        ->click('@create-idea-button')
        ->fill('title', 'My New Idea')
        ->click('@button-status-completed')
        ->fill('description', 'This is a description of my new idea.')
        ->fill('#new-step', 'Create a step for an idea')
        ->click('@add-step-button')
        ->fill('#new-step', 'Does this work?')
        ->click('@add-step-button')
        ->fill('#new-link', 'https://example.com')
        ->click('@add-link-button')
        ->fill('#new-link', 'https://example-number-two.com')
        ->click('@add-link-button')
        ->click('@submit-idea-button')
        ->assertPathIs('/ideas');

    expect(Idea::first())->toMatchArray([
        'user_id' => $user->id,
        'title' => 'My New Idea',
        'description' => 'This is a description of my new idea.',
        'status' => 'completed',
        'links' => [
            'https://example.com',
            'https://example-number-two.com',
        ],
    ]);
});
