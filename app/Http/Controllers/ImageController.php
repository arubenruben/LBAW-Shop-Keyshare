<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Picture;
use Image;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class ImageController extends Controller
{
    public function update(Request $Request){
        return;
    }
    
    public function convert(){

        $products=Product::all();

        foreach ($products as $product) {
            $now=Carbon::now()->timestamp;
            $hash=md5($product->name.$now);
            $dataBaseImage=new Picture;
            $dataBaseImage->url=$hash;
            $dataBaseImage->save();
            $id=$dataBaseImage->id;
            $img = Image::make('images/games/1.png');            
            $img->save('images/games/'.$hash.'.png');
            $product->picture_id=$id;
            $product->save();
        }
        return $id;
    }
}
