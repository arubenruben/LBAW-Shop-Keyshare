<?php

namespace App\Policies;

use App\Key;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class KeyPolicy
{
    use HandlesAuthorization;

    public function delete(User $user, Key $key)
    {
        // User can only delete items in cards they own
        return Auth::check() && $user->id == $key->offer->seller->id;
    }
}
