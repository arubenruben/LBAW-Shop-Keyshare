<?php


namespace App\Policies;

use App\Offer;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class UserPolicy
{
    use HandlesAuthorization;

    public function loggedIn(User $user) {
        // Only the own user can visit its purchases
        return true;

        //return Auth::check();
    }
    public function update(User $user) {
        // Only the own user can change any profile detail
        return Auth::check();
    }

    public function delete(User $user) {
        // Only the own user can change any profile detail
        return Auth::check();
    }
}