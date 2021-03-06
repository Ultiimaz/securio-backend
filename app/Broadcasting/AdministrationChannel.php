<?php

namespace App\Broadcasting;

use App\Administration;
use App\User;

class AdministrationChannel
{
    /**
     * Create a new channel instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Authenticate the user's access to the channel.
     *
     * @param User $user
     * @param Administration $administration
     * @return void
     */
    public function join(User $user,Administration $administration)
    {
       return $administration->members->contains($user);
    }
}
