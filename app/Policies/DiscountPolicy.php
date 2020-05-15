<?php

namespace App\Policies;

use App\Discount;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class DiscountPolicy
{
    use HandlesAuthorization;

    public function delete(User $user, Discount $discount)
    {
        // User can only delete items in cards they own
        return Auth::check() && $user->id == $discount->offer->seller->id;
    }
}
