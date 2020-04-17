<?php


namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class UserPolicy
{
    use HandlesAuthorization;

    public function show(User $user, User $visitor)
    {
        // Any logged user can see other users profiles
        return Auth::check();
    }

    public function delete(User $user, User $visitor)
    {
        // Only the own user can delete its account
        return user->id == visitor->id;
    }

    public function showPurchases(User $user, User $visitor)
    {
        // Only the own user can visit its purchases
        return user->id == visitor->id;
    }

    public function showOffers(User $user, User $visitor)
    {
        // Any logged user can see other users offers
        return Auth::check();
    }

    public function showReports(User $user, User $visitor)
    {
        // Only the own user can change any profile detail
        return user->id == visitor->id;
    }

    public function updateDescription(User $user, User $visitor)
    {
        // Only the own user can change any profile detail
        return user->id == visitor->id;
    }

    public function updatePassword(User $user, User $visitor)
    {
        // Only the own user can change any profile detail
        return user->id == visitor->id;
    }

    public function updateImage(User $user, User $visitor)
    {
        // Only the own user can change any profile detail
        return user->id == visitor->id;
    }

    public function deleteImage(User $user, User $visitor)
    {
        // Only the own user can change any profile detail
        return user->id == visitor->id;
    }

    public function updateEmail(User $user, User $visitor)
    {
        // Only the own user can change any profile detail
        return user->id == visitor->id;
    }

    public function updatePayPal(User $user, User $visitor)
    {
        // Only the own user can change any profile detail
        return user->id == visitor->id;
    }
}