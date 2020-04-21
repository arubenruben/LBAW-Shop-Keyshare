<?php


namespace App\Policies;

use App\Http\Requests\UserEditRequest;
use App\Offer;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class UserPolicy
{
    use HandlesAuthorization;

    public function ownUser(User $visitor) {
        // Only the own user can change any profile detail
        return Auth::check() && Auth::user() == $visitor;
    }

    public function loggedIn() {
        // Only the own user can visit its purchases
        return Auth::check();
    }

    public function update() {
        // Only the own user can change any profile detail
        return Auth::check();
    }

    public function delete() {
        // Only the own user can change any profile detail
        return Auth::check();
    }

    public function delete0ffer(int $offerId) {
        // Only the own user can change any profile detail
        return Auto::check() && Auth::id() == Offer::findOrfail($offerId)->seller;
    }


}