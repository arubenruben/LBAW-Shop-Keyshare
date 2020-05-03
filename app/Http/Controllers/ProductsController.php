<?php


namespace App\Http\Controllers;


use App\Category;
use App\Genre;
use App\Platform;
use App\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ProductsController
{
    public function explore(Request $request) {

        $products = Product::all('deleted', '=', false);

        $filtered = $this->filterProducts($request, $products);

        $products = Product::where('deleted', '=', false);
        $products = Product::all('deleted', '=', false);

        $filtered = $this->filterProducts($request, $products);


        $genres = Genre::all();
        $platforms = Platform::all();
        $categories = Category::all();

        $prices = [];
        foreach ($filtered as $product){
            array_push($prices, [$product->offers->min('price')]);
        }

        $min_price = min($prices);
        $max_price = max($prices);

        $request->has('page') ? $filtered = $filtered->forPage($request->input('page'), 9) :
            $filtered = $filtered->forPage(0, 9);

        return view('pages.products', ['genres' => $genres, 'platforms' => $platforms, 'categories' => $categories,
            'min_price' => $min_price, 'max_price' => $max_price, 'products' => $products, 'pages' => array('Products'), 'links'=>array(url('/products/'))]);
    }

    public function get(Request $request) {
        $products = Product::all()->where('deleted', false);
        $filtered = $this->filterProducts($request, $products);

        $request->has('page') ? $filtered = $filtered->forPage($request->input('page'), 9) :
            $filtered = $filtered->forPage(0, 9);

        $filtered = $filtered->map(function ($product, $key) {
            return [
                'id' => $product->id, 'name' => $product->name, 'description' => $product->description,
                'launch_date' => $product->launch_date, 'category' => $product->category->name,
                'platforms' => $product->platforms, 'genres' => $product->genres,
                'price' => $product->offers->min('price'),
            ];
        });

        return response()->json(['products' => array_values($filtered->toArray())]);
    }

        //return response(json_encode(Product::all()->first()->platforms), 400);
        //return response(json_encode(Product::all()->first()->genres->pluck('name')), 400);

        //return response(json_encode($products->platforms), 400);


    private function filterProducts(Request $request, Collection $products) : \Illuminate\Support\Collection {
        $filter = $products;
        if ($request->has('genres')) {
            $filter = $filter->filter(function(Product $product) use($request) {

        $this->filterProducts($request, $products);
        return response()->json(['products' => array_values($products->toArray())]);
    }

    private function filterProducts(Request $request, Collection $products) : \Illuminate\Support\Collection {
        $filter = $products;
        if ($request->has('genres')) {
            $products = $products->filter(function(Product $product) use($request) {

            $filter = $filter->filter(function(Product $product) use($request) {
                $decoded = explode(",", $request->input('genres'));
                $genres = $product->genres->map(function ($genre, $key) {
                    return $genre->name;
                });
                return count(array_intersect($decoded, $genres->toArray())) == count($decoded);

                return count(array_intersect($decoded, $product->genres->name->toArray())) == count($decoded);

            });
        }

        if ($request->has('platform')) {
            $filter = $filter->filter(function(Product $product) use($request) {
                foreach ($product->platforms as $platform)
                    if($platform->name == $request->input('platform'))
                        return true;

                return false;
            $products = $products->filter(function($product) use($request) {
                foreach ($product->platforms as $platform)
                    if($platform->name == $request->input('platform'))
                        return true;

                return false;
            });


        if ($request->has('category')) {
            $filter = $filter->filter(function(Product $product) use($request) {
            $products = $products->filter(function($product) use($request) {
                return $product->category->name == $request->input('category');
            });

        if ($request->has('max_price')) {
            $filter = $filter->filter(function(Product $product) use($request) {
                return $product->offers->min('price') <= $request->input('max_price');
            });
        }

        if ($request->has('sort_by')) {
            if($request->input('sort_by') === 'Most popular') {
                $filter = $filter->sortByDesc('num_sells');
            } else if($request->input('sort_by') === 'Most recent') {
                $filter = $filter->sortByDesc('launch_date');
            }
        }

        return $filter;
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