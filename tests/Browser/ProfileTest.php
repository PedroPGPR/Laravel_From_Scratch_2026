<?php

use App\Models\User;

it('requires authentication', function () {
    $this->get(route('profile.edit'))->assertRedirect('/login');
});

it('edits a proFile', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    visit(route('profile.edit'))
        ->assertValue('name', $user->name)
        ->fill('name', 'New Name')
        ->assertValue('email', $user->email)
        ->fill('email', 'new@example.com')
        ->click('Update Account')
        ->assertSee('Profile updated successfully.');

    expect($user->fresh())->toMatchArray([
        'name' => 'New Name',
        'email' => 'new@example.com',
    ]);
});

it('notifies the original email if updated', function () {})->todo();
