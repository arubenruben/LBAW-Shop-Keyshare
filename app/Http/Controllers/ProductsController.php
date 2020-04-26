<?php


namespace App\Http\Controllers;


use App\Http\Requests\ProductsRequest;
use App\Product;
use Illuminate\Support\Facades\Auth;

class ProductsController
{
    public function show(ProductsRequest $request) {

        /*if (isset($request->sort)) {
        }

        if (isset($request->genres)) {
        }

        if (isset($request->platform)) {
        }

        if (isset($request->category)) {
        }

        if (isset($request->max_price)) {
        }*/

        $products = Product::where('deleted', '=', false)->paginate(9);
        return view('pages.products', ['products' => $products, 'pages' => array('User'), 'links'=>array(url('/products/'))]);
    }

    public function search() {
        $input = Input::get('input');
        $products = Product::whereRaw('delted = false and name_tsvector @@ plainto_tsquery('.$input.')')->paginate(9);
        return view('pages.products', ['products' => $products, 'pages' => array('User'), 'links'=>array(url('/products/'))]);
    }

}