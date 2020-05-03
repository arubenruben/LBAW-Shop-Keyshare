<?php


namespace App\Http\Controllers;


use App\Platform;
use App\Product;
use App\Offer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
    public function getProduct($productName){
        
        $product=DB::table('products')->select('id')->where('name','=',$productName)->first(); 

        return Product::findOrFail($product->id);    
    }

    public function getPlatform($platformName){
        
        $platform=DB::table('platforms')->select('id')->where('name','=',$platformName)->first();
        
        return Platform::findOrFail($platform->id);
    }


    public function show($productName, $platformName) {

        $product = $this->getProduct($productName);
            
        $platform= $this->getPlatform($platformName);

        $offers = Offer::where('product_id', '=', $product->id)->where('platform_id', '=', $platform->id)->get();
        $platformName =$platform->name;

        return view('pages.product', ['user' => Auth::user(), 'product' => $product, 'platformName' => $platformName, 'offers' => $offers, 'pages' => array($product->name.'['.$platform->name.']'), 'links'=>array(url('/product/'.$product->name.'/'.$platform->name))]);
    }

}