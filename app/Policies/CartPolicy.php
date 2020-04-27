<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Offer;

class CartPolicy 
{
    use HandlesAuthorization;
    public function loggedIn(User $user) {
        
        return Auth::check();
    }
    public function delete(User $user, Offer $offer){
        


    }
    
}

?>
