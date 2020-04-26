<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Cart;

class CartController extends Controller
{

    public function show()
    {
        return view('pages.cart.cart',['pages'=> array('Cart'),'links'=>array(url('cart'))]);
    }
    
}



?>