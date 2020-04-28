<?php


namespace App\Http\Controllers;


use App\Platform;
use App\Product;
use App\Offer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{

    public function show($productId, $platform) {

        $product =  Product::findOrFail($productId);

        $offers = Offer::where('product_id', '=', $product->id)->where('platform_id', '=', $platform)->get();
        $platformName = Platform::findOrFail($platform)->name;

        return view('pages.product', ['user' => Auth::user(), 'product' => $product, 'platformName' => $platformName, 'offers' => $offers, 'pages' => array('product'), 'links'=>array(url('/product/'.$productId.'/'.$platform))]);
    }

}