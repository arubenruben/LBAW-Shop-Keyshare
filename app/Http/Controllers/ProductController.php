<?php


namespace App\Http\Controllers;


use App\Product;

class ProductController
{

    public function show($id, $platform) {

        $product =  Product::findOrFail($id);

        $offers = $product->offers->where('platform_id', '=', $platform)->orderBy('price', 'ASC');

        return view('pages.product', ['product' => $product, 'offers' => $offers, 'pages' => array('product'), 'links'=>array(url('/product/'.$id.'/'.$platform))]);
    }

}