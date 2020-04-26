<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Policies\CartPolicy;
use App\Cart;

class CartController extends Controller
{
    
    public function show()
    {
        try {
            $this->authorize('loggedIn',Cart::class);
        }catch (AuthorizationException $e) {
            return response(json_encode($e->getMessage()), 400);
        }

        return view('pages.cart.cart',['data'=>array(),'pages'=> array('Cart'),'links'=>array(url('cart'))]);
    }
    
}



?>