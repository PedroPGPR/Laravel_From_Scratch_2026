<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\User;
use Illuminate\Container\Attributes\CurrentUser;
use Illuminate\Support\Facades\DB;
use Throwable;

class CreateIdeaAction
{
    public function __construct(#[CurrentUser] protected User $user) {}

    /**
     * @throws Throwable
     */
    public function handle(array $attributes): void
    {
        // Prepare data for idea
        $data = collect($attributes)->only(['title', 'description', 'status', 'links'])->toArray();

        if ($attributes['image'] ?? false) {
            $data['image_path'] = $attributes['image']->store('ideas', 'public');
        }

        DB::transaction(function () use ($data, $attributes) {
            $idea = $this->user->ideas()->create($data);

            // Prepare data for steps
            $steps = collect($attributes['steps'] ?? [])->map(fn ($step) => ['description' => $step]);
            $idea->steps()->createMany($steps);
        });
    }
}
