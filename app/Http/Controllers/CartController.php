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
        $loggedIn=true;
        $data=array();
        try {
            $this->authorize('loggedIn',Cart::class);
            $user = Auth::user();
        }catch (AuthorizationException $e) {
            $loggedIn=false;    
        }
        
        $user=$user->cart;
        
        for($i=0;$i<count($user);$i++){
            
            $data[$i]=Cart::find($user[$i]['id']);
            
        }
        

        return view('pages.cart.cart',['data'=>$data,'pages'=> array('Cart'),'links'=>array(url('cart'))]);
    }

}
?>