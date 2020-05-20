<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Access\AuthorizationException;
use App\Order;
use App\Key;
use App\Offer;
use App\Product;
use App\Policies\OrderPolicy;
use Illuminate\Http\Request;

class OrderController extends Controller{

    public function get(Request $request,$orderNumber){
        
        if($orderNumber===NULL)
            return response(json_encode("OrderNumber Not Found"),400);
        
        $order=Order::findOrFail($orderNumber);
        try {
            $this->authorize('buyer', $order);
        } catch (AuthorizationException $e) {
            return response(json_encode("You cant Review That Order"),400);
        }
        return response(json_encode(['order'=>$order]),200);     
    }
}



?>