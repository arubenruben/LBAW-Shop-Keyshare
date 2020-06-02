<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Cart;

class CartPolicy 
{
    use HandlesAuthorization;
    public function loggedIn(User $user) {        
        return Auth::check();
    }
    public function delete(User $user, Cart $cart){
        return Auth::check() &&($user->id === $cart->user_id);
    }
    
}

?>