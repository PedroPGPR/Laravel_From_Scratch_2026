<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Idea;
use App\Models\User;

class IdeaPolicy
{
    /**
     * Determine whether the user can work with given Idea.
     */
    public function workWidth(User $user, Idea $idea): bool
    {
        return $idea->user->is($user);
    }
}
