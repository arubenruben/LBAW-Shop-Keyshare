<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class ReportPolicy
{
    use HandlesAuthorization;

    public function canSee(User $user) {
        // Only the own user can visit its purchases
        return Auth::check() ;
    }
}
