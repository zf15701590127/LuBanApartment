<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Topic;

class TopicPolicy
{
    use HandlesAuthorization;

    public function foreUpdate(User $user, Topic $topic)
    {
        return $topic->user_id == $user->id;
    }
}
