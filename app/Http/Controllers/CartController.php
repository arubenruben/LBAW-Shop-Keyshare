<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Policies\CartPolicy;
use App\Cart;
use App\Offer;

class CartController extends Controller
{

    public function show(Request $request)
    {
        
        $item=Cart::findOrFail(1);
        
        $request->session()->forget('cart');   
        $request->session()->push('cart', $item);
        $request->session()->push('cart', $item);
        $request->session()->push('cart', $item);
        $request->session()->push('cart', $item);
    
        $loggedIn=true;
        $data=array();

        try {
            $this->authorize('loggedIn',Cart::class);
            $user = Auth::user();
        }catch (AuthorizationException $e) {
            $loggedIn=false;    
        }
        
        if($loggedIn){
            
            $user=$user->cart;
    
            for($i=0;$i<count($user);$i++){
                $data[$i]=Cart::findOrFail($user[$i]['id']);
            }
        }else{
            $cartItemsInSession=$request->session()->get('cart');

            for($i=0;$i<count($cartItemsInSession);$i++){
                $data[$i]=Cart::findOrFail($cartItemsInSession[$i]['id']);
            }
        }
        
        return view('pages.cart.cart',['data'=>$data,'pages'=> array('Cart'),'links'=>array(url('cart'))]);
    }

    public function delete($cartId) {
        $loggedIn=true;
        $cart = Cart::findOrFail($cartId);

        try {
            $this->authorize('delete',$cart);
            $user = Auth::user();
        } catch (AuthorizationException $e) {
            $loggedIn=false;
        }

        if($loggedIn){

            $cart->delete();


        }else{






        }

        return response(json_encode("Success"), 200);
    }

}
?>