<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function manage(User $currentUser)
    {
        if ($currentUser->id == 1) {
            return true;
        }
        return false;
    }

    public function update(User $currentUser, User $user)
    {
        return $currentUser->id === $user->id;
    }
}
