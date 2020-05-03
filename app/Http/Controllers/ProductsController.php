<?php


namespace App\Http\Controllers;


use App\Category;
use App\Genre;
use App\Platform;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ProductsController
{
    public function explore(Request $request) {

        $products = Product::where('deleted', '=', false);


        /*if (isset($request->genres)) {
        }*/

        if (isset($request->platform)) {
            //$products = $products->platform();
        }

        /*if (isset($request->category)) {
        }

        if (isset($request->max_price)) {
        }*/

        if (isset($request->sort_by)) {
            if($request->sort_by === 'Most popular') {
                $products->orderBy('num_sells', 'desc');
            } else if($request->sort_by === 'Most recent') {
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

    public function get(Request $request) {
        $products = Product::all();
        $products->where('deleted', false);

        //return response(json_encode(Product::all()->first()->platforms->pluck('name')->first()), 400);
        //return response(json_encode(Product::all()->first()->genres->pluck('name')), 400);

        //return response(json_encode($request->input('category')), 400);
        return response(json_encode(Product::find(25)->category->pluck('name')->first()), 400);


        if ($request->has('genres')) {
            $products = $products->filter(function($product) use($request) {
                $decoded = explode(",", $request->input('genres'));
                return count(array_intersect($decoded, $product->genres->pluck('name')->toArray())) == count($decoded);
            });
        }

        if ($request->has('platform')) {
            $products = $products->filter(function($product) use($request) {
                return $product->platforms->pluck('name')->first() == $request->input('platform');
            });
        }

        if ($request->has('category')) {
            $products = $products->filter(function($product) use($request) {
                return $product->category->pluck('name')->first() == $request->input('category');
            });
        }

        //if ($request->has('max_price')) {  }

        if ($request->has('sort_by')) {
            if($request->input('sort_by') === 'Most popular') {
                $products->sortByDesc('num_sells');
            } else if($request->input('sort_by') === 'Most recent') {
                $products->sortByDesc('launch_date');
            }
        }

        $request->has('page') ? $products = $products->forPage($request->input('page'), 9) :
            $products = $products->forPage(0, 9);

        return response(json_encode(['products' => $products]), 200);
    }

    public function search() {
        $input = Input::get('input');
        $products = Product::whereRaw('delted = false and name_tsvector @@ plainto_tsquery('.$input.')')->paginate(9);
        return view('pages.products', ['products' => $products, 'pages' => array('Products'), 'links'=>array(url('/products/'))]);
    }

}