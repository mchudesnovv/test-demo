<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    /**
     * Handle the User "creating" event.
     *
     * @param User $user
     * @return void
     */
    public function creating(User  $user)
    {
        if(is_null($user->status))
        {
            $user->setInactive();
        }
    }
}
