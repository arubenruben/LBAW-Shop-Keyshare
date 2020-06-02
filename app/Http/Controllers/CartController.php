<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutInfoRequest;
use App\Order;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Cart;
use App\Offer;
Use Braintree;

class CartController extends Controller
{
    public function show(Request $request)
    {    
        $data=array();

        $this->authorize('loggedIn',Cart::class);
        $user = Auth::user();
        $loggedIn = true;
        
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
            'breadcrumbs' => ['Cart' => route('showCart')]]);
            
    }

    public function delete(Request $request,$cartId) {

        $cart = Cart::find($cartId);
        $loggedIn=false;

        if(isset($cart)){
            $this->authorize('delete',$cart);
            $user = Auth::user();
            $loggedIn=true;
        }

        //If logged in delete the cart entry from the database
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
        $this->authorize('loggedIn',Cart::class);
        $user = Auth::user();
        $loggedIn=true;

        $offer = Offer::find($request->offer_id);
        $stock = $offer->stock;

        $cart = new Cart;

        if($loggedIn){       
            
           if(!$this->checkOfferStock($user->cart,$request->offer_id,$stock))
                response(json_encode("Out of Stock"), 401);

            $cart->user_id = $user->id;
            $cart->offer_id = $offer->id;
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

        return response(json_encode("Success"), 200);
    }
    private function checkOfferStock($arrayCart,$offerId,$stock){
        
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

    public function checkout(Request $request)
    {

        $loggedIn=true;
        $data=array();

        $this->authorize('loggedIn',Cart::class);
        $user = Auth::user();

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


        return view('pages.cart.checkout',['totalPrice' => $totalPrice,'loggedIn'=>$loggedIn, 'clientToken' => $this->generateClientToken(), 'userCartEntries' => $data,
                'breadcrumbs' => ['Cart' => url('/cart'), 'Checkout' => url('/cart/checkout')]]);

    }

    public function getCartTotalPrice(Request $request){

        $loggedIn=true;
        $data=array();

        $this->authorize('loggedIn',Cart::class);
        $user = Auth::user();

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

        for($i=0;$i<count($data); $i++){
            $collectionOffers->add($data[$i]->offer);
        }


        return [
            'amount' => $collectionOffers->sum('discountPriceColumn'),
        ];


    }

    public function generateClientToken(){

        $gateway = new Braintree\Gateway([
            'accessToken' => 'access_token$sandbox$zxjj8c9jrsb489sf$217d59bb704d10cb0adf25d6cbb78604',
        ]);

        $clientToken = $gateway->clientToken()->generate();

        return $clientToken;

    }

    public function finishCheckout(CheckoutInfoRequest $request){
        // Access token
        $gateway = new Braintree\Gateway([
            'accessToken' => 'access_token$sandbox$zxjj8c9jrsb489sf$217d59bb704d10cb0adf25d6cbb78604',
        ]);

        $user = Auth::user();


        // The total price the client will be charged
        $totalPrice = $this->getCartTotalPrice($request)['amount'];

        // Used in the description of the paypal transaction
        $line_items = array();
        for($i = 0; $i < count($user->cart); $i++){
            $line_items[$i] = [
                'name' => $user->cart[$i]->offer->product->name." ".$user->cart[$i]->offer->platform->name,
                'quantity' => 1,
                'unit_amount' => $user->cart[$i]->offer->discountPriceColum,
                'kind' => 'debit',
                'total_amount' => $user->cart[$i]->offer->discountPriceColum,
            ];
        }


        // complete the transaction and add a order
        try {
            DB::beginTransaction();
            $this->createOrder($request->input('name'), $request->input('email'), $request->input('address'), $request->input('zipcode'), $user->cart, $user->id);
            // Create a transaction
            $result = $gateway->transaction()->sale([
                'amount' => $totalPrice,
                'orderId' => $request->orderID,
                'merchantAccountId' => 'USD',
                'paymentMethodNonce' => $request->nonce,
                'options' => [
                    'submitForSettlement' => true
                ]
            ]);


            if ($result->success) {
                DB::commit();
                return [
                    'success' => true,
                    'message' => 'Transaction was a success with id'.$result->transaction->id,
                ];
            }
            else{
                DB::rollBack();
                return [
                    'success' => false,
                    'message' => $result->message
                ];
            }
        }
        catch (Exception $e){
            DB::rollBack();

            $this->checkIfKeysAreAvailable($user->cart);

            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }


    }


    public function checkIfKeysAreAvailable($userCartEntries){


        $cartEntriesToEliminate = collect();

        for ($i = 0; $i < count($userCartEntries); $i++) {
            $keys = $userCartEntries[$i]->offer->keys;
            $keyExists = false;
            for ($j = 0; $j < count($keys); $j++) {
                if (is_null($keys[$j]->order_id) && is_null($keys[$j]->price_sold)) {
                    $keyExists = true;
                    break;
                }
            }
            if(!$keyExists)
                $cartEntriesToEliminate->add($userCartEntries[$i]);
        }

        if(count($cartEntriesToEliminate) > 0){
            for($i = 0; $i < count($cartEntriesToEliminate); $i++)
            Cart::where('user_id', $cartEntriesToEliminate[$i]->user_id)->where('offer_id', $cartEntriesToEliminate[$i]->offer_id)->delete();
        }

    }
    public function createOrder($name, $email, $address, $zipcode, $userCartEntries, $userId){

        $order = new Order();

        $order->order_info_name = $name;
        $order->order_info_email = $email;
        $order->order_info_address = $address;
        $order->order_info_zipcode = $zipcode;
        $order->user_id = $userId;
        $order->date = "2020-04-03";

        $order->save();

        for ($i = 0; $i < count($userCartEntries); $i++) {
            $keys = $userCartEntries[$i]->offer->keys;
            $keyExists = false;
            for ($j = 0; $j < count($keys); $j++) {
                if (is_null($keys[$j]->order_id) && is_null($keys[$j]->price_sold)) {
                    $keys[$j]->order_id = $order->number;
                    $keys[$j]->price_sold = $userCartEntries[$i]->offer->discountPriceColumn;
                    $keys[$j]->save();
                    $keyExists = true;
                    break;
                }
            }
            if (!$keyExists) {
                throw new Exception("No available key for certain offer");
            }
            $userCartEntries[$i]->offer->stock -= 1;
            $userCartEntries[$i]->offer->save();
        }
        
        Cart::where('user_id', $userId)->delete();
    }


}