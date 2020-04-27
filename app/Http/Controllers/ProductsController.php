<?php


namespace App\Http\Controllers;


use App\Category;
use App\Genre;
use App\Http\Requests\ProductsRequest;
use App\Platform;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ProductsController
{
    public function show(Request $request) {

        $products = Product::where('deleted', '=', false);

        /*if ($request->has('sort')) {
            abort(404);
        }
        $request->input('id')*/



        /*if (isset($request->genres)) {
        }*/

        /*if (isset($request->platform)) {
            $products = $products->whereHas()
        }*/

        /*if (isset($request->category)) {
        }

        if (isset($request->max_price)) {
        }*/

        if (isset($request->sort)) {
            abort(404);
            if($request->sort == 'Most popular') {
                $products->orderBy('num_sells', 'desc');
            } else if($request->sort == 'Most recent') {
                $products->latest('launch_date');
            }
        }

        $genres = Genre::all();
        $platforms = Platform::all();
        $categories = Category::all();
        $products = $products->paginate(9);

        $min_price = 0;
        $max_price = 0;

        return view('pages.products', ['genres' => $genres, 'platforms' => $platforms, 'categories' => $categories,
            'min_price' => $min_price, 'max_price' => $max_price, 'products' => $products, 'pages' => array('Products'), 'links'=>array(url('/products/'))]);
    }

    public function search() {
        $input = Input::get('input');
        $products = Product::whereRaw('delted = false and name_tsvector @@ plainto_tsquery('.$input.')')->paginate(9);
        return view('pages.products', ['products' => $products, 'pages' => array('Products'), 'links'=>array(url('/products/'))]);
    }

}