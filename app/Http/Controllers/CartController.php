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
        $data=array();
        try {
            $this->authorize('loggedIn',Cart::class);
            $user = Auth::user();
            $loggedIn=true;
        }catch (AuthorizationException $e) {
            $loggedIn=false;    
        }
        
        //If logged in -> Get the Cart from the database
        if($loggedIn){          
            //Get Content in the session
            $cart=$user->cart;
            
            for($i=0;$i<count($cart);$i++){
                $data[$i]=Cart::findOrFail($cart[$i]->id);
            }
        }
        else if($request->session()->has('cart')){
            //If not logged int get the cart from the session cookie if exists
            $cartItemsInSession=$request->session()->get('cart');
            for($i=0;$i<count($cartItemsInSession);$i++){
                $data[$i]=$cartItemsInSession[$i];
            }
        }
        
        return view('pages.cart.cart',['data'=>$data,'loggedIn'=>$loggedIn,
            'breadcrumbs' => ['Cart' => url('/cart')]]);
            
    }

    public function delete(Request $request,$cartId) {

        $cart = Cart::find($cartId);
        $loggedIn=false;

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
        }
        //If not logged in refresh the content of the session variable
        else if($request->session()->has('cart')){
            
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

    
        try {
            $this->authorize('loggedIn');
            $user = Auth::user();
            $loggedIn=true;    
        } catch (AuthorizationException $e) {
            $loggedIn=false;
        }
        
        $offer=Offer::find($request->offer_id);
        $stock=$offer->stock;

        $cart=new Cart;

        if($loggedIn){       
            
           if(!$this->checkOfferStock($user->cart,$request->offer_id,$stock))
                response(json_encode("Out of Stock"), 401);

            $cart->user_id=$user->id;
            $cart->offer_id=$offer->id;
            $cart->save();
        }else{
        
            if($request->session()->has('cart')&& !$this->checkOfferStock($request->session()->get('cart'),$request->offer_id,$stock))
                return response(json_encode("Out of Stock"), 401);

            if($request->session()->has('cart')){            
                $cart->id=count($request->session()->get('cart'));
            }else{
                $cart->id=0;
            }

            $cart->user_id=-1;
            $cart->offer_id=$offer->id;                        
            $request->session()->push('cart', $cart);
        }

        return response(json_encode("Sucess"), 200);
    }
    protected function checkOfferStock($arrayCart,$offerId,$stock){
        
        for($i=0;$i<count($arrayCart);$i++){
            
            $counter=0;

            if($arrayCart[$i]->offer_id==$offerId){
                $counter++;    
            }

            if($counter>=$stock)
                return false;
        }
        
        return true;
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


        return view('pages.cart.checkout',['totalPrice' => $totalPrice,'loggedIn'=>$loggedIn, 'userCart' => $data,
                'breadcrumbs' => ['Cart' => url('/cart'), 'Checkout' => url('/cart/checkout')]]);

    }

    public function finalizeCheckout()
    {
        if(true){
            $transactionSucess = true;
        }



        return view('pages.cart.checkout',[
            'breadcrumbs' => ['Cart' => url('/cart'), 'Checkout' => url('/cart/checkout')]]);


    }
}