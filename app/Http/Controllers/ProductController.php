<?php


namespace App\Http\Controllers;


use App\Product;

class ProductController extends Controller
{

    public function show($productId, $platform) {

        $product =  Product::findOrFail($productId);

        $offers = $product->offers->where('platform_id', '=', $platform)->orderBy('price', 'ASC');

        return view('pages.product', ['product' => $product, 'offers' => $offers, 'pages' => array('product'), 'links'=>array(url('/product/'.$productId.'/'.$platform))]);
    }

}