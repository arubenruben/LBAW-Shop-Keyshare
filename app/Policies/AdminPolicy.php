<?php


namespace App\Policies;

use App\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class AdminPolicy
{
    use HandlesAuthorization;

    public function addProduct(Admin $admin) {
        
        Admin::findOrFail(Auth::id());
        
        return Auth::check();
    }

}