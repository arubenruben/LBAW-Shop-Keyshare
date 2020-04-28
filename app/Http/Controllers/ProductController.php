<?php


namespace App\Http\Controllers;


use App\Product;
use App\Offer;

class ProductController extends Controller
{

    public function show($productId, $platform) {

        $product =  Product::findOrFail($productId);

        $offers = $product->offers->where('platform_id', '=', $platform)->get();

        $offers = $offers->orderBy('discountPrice', 'ASC');

        return view('pages.product', ['product' => $product, 'offers' => $offers, 'pages' => array('product'), 'links'=>array(url('/product/'.$productId.'/'.$platform))]);
    }

}