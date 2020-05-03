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

        $this->filterProducts($request, $products);

        $genres = Genre::all();
        $platforms = Platform::all();
        $categories = Category::all();

        $min_price = 0;
        $max_price = 0;

        return view('pages.products', ['genres' => $genres, 'platforms' => $platforms, 'categories' => $categories,
            'min_price' => $min_price, 'max_price' => $max_price, 'products' => $products, 'pages' => array('Products'), 'links'=>array(url('/products/'))]);
    }

    public function get(Request $request) {
        $products = Product::all()->where('deleted', false);
        $this->filterProducts($request, $products);
        return response()->json(['products' => array_values($products->toArray())]);
    }

    private function filterProducts($request, $products) {
        if ($request->has('genres')) {
            $products = $products->filter(function(Product $product) use($request) {
                $decoded = explode(",", $request->input('genres'));
                $genres = $product->genres->map(function ($genre, $key) {
                    return $genre->name;
                });
                return count(array_intersect($decoded, $genres->toArray())) == count($decoded);
            });
        }

        if ($request->has('platform')) {
            $products = $products->filter(function($product) use($request) {
                foreach ($product->platforms as $platform)
                    if($platform->name == $request->input('platform'))
                        return true;

                return false;
            });
        }

        if ($request->has('category')) {
            $products = $products->filter(function($product) use($request) {
                return $product->category->name == $request->input('category');
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

        $products = $products->map(function ($product, $key) {
            return [
                'id' => $product->id, 'name' => $product->name, 'description' => $product->description,
                'launch_date' => $product->launch_date, 'category' => $product->category->name,
                'platforms' => $product->platforms, 'genres' => $product->genres,
            ];
        });
    }

    public function search() {
        $input = Input::get('input');
        $products = Product::whereRaw('delted = false and name_tsvector @@ plainto_tsquery('.$input.')')->paginate(9);
        return view('pages.products', ['products' => $products, 'pages' => array('Products'), 'links'=>array(url('/products/'))]);
    }

}