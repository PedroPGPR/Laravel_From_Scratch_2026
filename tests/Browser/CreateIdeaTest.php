<?php

use App\Models\Idea;
use App\Models\User;
use function Pest\Laravel\assertDatabaseHas;

it('can create a idea', function () {
    $this->actingAs($user = User::factory()->create());

    visit('/ideas')
        ->click('@create-idea-button')
        ->fill('title', 'My New Idea')
        ->click('@button-status-completed')
        ->fill('description', 'This is a description of my new idea.')
        ->click('@submit-idea-button')
        ->assertPathIs('/ideas');

    expect(Idea::first())->toMatchArray([
        'user_id' => $user->id,
        'title' => 'My New Idea',
        'description' => 'This is a description of my new idea.',
        'status' => 'completed',
    ]);
});
