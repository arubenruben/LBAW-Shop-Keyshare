<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Order;

class OrderPolicy
{
    use HandlesAuthorization;

    public function unbanned(User $user) {
        // Only the an authenticated not banned user can make an offer
        return Auth::check() && Auth::user()->isBanned() === false;
    }

    public function buyer(User $user, Order $order) {
        // Only the owner of the offer can change any details
        return Auth::check() && Auth::user()->isBanned() === false && ($user->id === $order->user_id);
    }
}