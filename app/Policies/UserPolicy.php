<?php


namespace App\Policies;

use App\Offer;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class UserPolicy
{
    use HandlesAuthorization;

    public function ownUser(User $user, User $visitor) {
        // Only the own user can change any profile detail
        return Auth::check() && $user == $visitor;
    }

    public function loggedIn(User $user) {
        // Only the own user can visit its purchases
        return Auth::check();
    }

    public function update(User $user) {
        // Only the own user can change any profile detail
        return Auth::check();
    }

    public function delete(User $user) {
        // Only the own user can change any profile detail
        return Auth::check();
    }

    public function delete0ffer(Offer $offer) {
        // Only the own user can change any profile detail
        return Auto::check() && Auth::id() == Offer::findOrfail($offer->id)->seller;
    }


}