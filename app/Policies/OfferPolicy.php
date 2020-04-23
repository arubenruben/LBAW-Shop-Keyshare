<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Offer;
use Illuminate\Support\Facades\Auth;

class OfferPolicy
{
    use HandlesAuthorization;

    public function cancel(User $user, Offer $offer) {
        // Only the own user can change any profile detail
        
        return Auth::check() && ($user->id === $offer->user_id);
    }
}
