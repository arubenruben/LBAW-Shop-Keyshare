<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Collection;
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
        
            if($request->session()->has('cart')){
                
                $cartItemsInSession=$request->session()->get('cart');
                
                for($i=0;$i<count($cartItemsInSession);$i++){
                    $cartEntry=new Cart;
                    $cartEntry->offer_id=$cartItemsInSession[$i]->offer->id;
                    $cartEntry->user_id=$user->id;                
                    $cartEntry->save();
                }
                $request->session()->forget('cart');
            }

            $user=$user->cart;
    
            for($i=0;$i<count($user);$i++){
                $data[$i]=Cart::findOrFail($user[$i]['id']);
            }
            //Add cart content to User information
        }
        //If not logged int get the cart from the session cookie if exists
        else if($request->session()->has('cart')){
            $cartItemsInSession=$request->session()->get('cart');

            for($i=0;$i<count($cartItemsInSession);$i++){
                $data[$i]=$cartItemsInSession[$i];
            }
        }
        
        return view('pages.cart.cart',['data'=>$data,'loggedIn'=>$loggedIn,
            'breadcrumbs' => ['Cart' => url('/cart')]]);
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
    
    public function add(Request $request){

        $loggedIn=true;

        $cart=new Cart;
            
        try {
            $this->authorize('loggedIn',$cart);
            $user = Auth::user();    
        } catch (AuthorizationException $e) {
            $loggedIn=false;
        }

        if($loggedIn){            
            $cart->user_id=$user->id;
            $cart->offer_id=$request->offer_id;
            $cart->save();
            $request->session()->push('cart', $cart);
        }else{
            
            if($request->session()->has('cart')){            
                $cart->id=count($request->session()->get('cart'));
            }else{
                $cart->id=0;
            }

            $cart->user_id=-1;
            $cart->offer=Offer::find($request->offer_id);
                        
            $request->session()->push('cart', $cart);
        }

        return response(json_encode($cart), 200);
    }

    public function checkout(Request $request, $page)
    {

        if($page != 1 && $page != 2){
            abort(404);
        }

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

        $collectionOffers = collect();

        for($i=0;$i<count($data);$i++){
           $collectionOffers->add($data[$i]->offer);
        }

        $totalPrice = $collectionOffers->sum('discountPriceColumn');

        $transactionResult = true;

        if($page == 1){
            return view('pages.cart.checkoutPage1',['totalPrice' => $totalPrice,'loggedIn'=>$loggedIn,
                'breadcrumbs' => ['Cart' => url('/cart'), 'Checkout' => url('/cart/checkout')]]);
        }
        else if($page == 2){
            return view('pages.cart.checkoutPage2',['totalPrice' => $totalPrice, 'data'=>$data,'loggedIn'=>$loggedIn,
                'breadcrumbs' => ['Cart' => url('/cart'), 'Checkout' => url('/cart/checkout')]]);
        }


    }

    public function finalizeCheckout()
    {
        return view('pages.cart.checkoutPage3',['loggedIn'=>$loggedIn,
            'breadcrumbs' => ['Cart' => url('/cart'), 'Checkout' => url('/cart/checkout')]]);


    }
}
