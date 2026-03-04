<?php

use App\Models\Idea;
use App\Models\Step;
use Illuminate\Database\Eloquent\Collection;

it('belongs to a user', function () {
    $idea = Idea::factory()->create();

    expect($idea->user)->toBeInstanceOf(\App\Models\User::class);
});

it('can have many steps', function () {
    $idea = Idea::factory()->create();

    expect($idea->steps)->toBeInstanceOf(Collection::class);

    $idea->steps()->saveMany(Step::factory()->count(3)->make());

    expect($idea->fresh()->steps)->toHaveCount(3);
});
