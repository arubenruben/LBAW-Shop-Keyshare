<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Offer;
use Illuminate\Support\Facades\Auth;

class OfferPolicy
{
    use HandlesAuthorization;

    public function unbanned(User $user) {
        // Only the an authenticated not banned user can make an offer

        return Auth::check() && Auth::user()->isBanned() === false;
    }

    public function unfinished(User $user, Offer $offer) {
        // Only the an authenticated not banned user can make an offer

        return $this->seller($user, $offer) && $offer->final_date === null;
    }

    public function seller(User $user, Offer $offer) {
        // Only the owner of the offer can change any details

        return Auth::check() && ($user->id === $offer->user_id);
    }
}
