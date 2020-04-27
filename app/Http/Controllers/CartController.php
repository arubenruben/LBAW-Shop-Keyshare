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
        $loggedIn=true;
        $data=array();
        
        try {
            $this->authorize('loggedIn',Cart::class);
            $user = Auth::user();
        }catch (AuthorizationException $e) {
            $loggedIn=false;    
        }
        //If logged in -> Get the Cart from the database
        if($loggedIn){            
            $user=$user->cart;
    
            for($i=0;$i<count($user);$i++){
                $data[$i]=Cart::findOrFail($user[$i]['id']);
            }
            //If not logged int get the cart from the session cookie if exists
        }else if($request->session()->has('cart')){
            $cartItemsInSession=$request->session()->get('cart');

            for($i=0;$i<count($cartItemsInSession);$i++){
                $data[$i]=$cartItemsInSession[$i];
            }
        }
        
        return view('pages.cart.cart',['data'=>$data,'loggedIn'=>$loggedIn,'pages'=> array('Cart'),'links'=>array(url('cart'))]);
    }

    public function delete(Request $request,$cartId) {
        $loggedIn=false;

        $cart = Cart::find($cartId);

        if(isset($cart)){
            try {
                $this->authorize('delete',$cart);
                $user = Auth::user();
                $loggedIn=true;
            } catch (AuthorizationException $e) {
                $loggedIn=false;
            }
        }
        //IF logged in delete the cart entry from the database
        if($loggedIn){

            $cart->delete();
        //If not logged in refresh the content of the session variable
        }else if($request->session()->has('cart')){

            $cartSessionContent=$request->session()->get('cart');
            $tempArray=array();
            
            //Copy of session cart
            for($i=0;$i<count($cartSessionContent);$i++)
                array_push($tempArray, $cartSessionContent[$i]);


            $request->session()->forget('cart');
    
            for($i=0;$i<count($tempArray);$i++){
                if($tempArray[$i]->id!=$cartId)
                    $request->session()->push('cart', $tempArray[$i]);
            }        
        }
        return response(json_encode("Success"), 200);
    }
    
    public function insert(Request $request){

        $loggedIn=true;

        $cart=new Cart;
            
        try {
            $this->authorize('insert',$cart);
            $user = Auth::user();    
        } catch (AuthorizationException $e) {
            $loggedIn=false;
        }

        if($loggedIn){
            
            $cart->user_id=$user->id;
            $cart->offer_id=$request->offer_id;
            $cart->save();
        
        }else{
            $cart->user_id=-1;
            $cart->offer_id=$request->offer_id;
            
            $request->session()->push('cart', $cart);
        }

        return response(json_encode("Success"), 200);
    }
}
?>
