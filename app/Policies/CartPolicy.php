<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class CartPolicy 
{
    use HandlesAuthorization;
    public function loggedIn(User $user) {
        
        return Auth::check();
    }
    
}

?>
