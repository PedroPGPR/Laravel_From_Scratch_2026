<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Idea;
use Illuminate\Support\Facades\DB;
use Throwable;

class UpdateIdeaAction
{
    /**
     * @throws Throwable
     */
    public function handle(array $attributes, Idea $idea): void
    {
        // Prepare data for idea
        $data = collect($attributes)->only([
            'title',
            'description',
            'status',
            'links']
        )->toArray();

        if ($attributes['image'] ?? false) {
            $data['image_path'] = $attributes['image']->store('ideas', 'public');
        }

        DB::transaction(function () use ($data, $attributes, $idea) {
            $idea->update($data);
            $idea->steps()->delete();
            $idea->steps()->createMany($attributes['steps'] ?? []);
        });
    }
}
