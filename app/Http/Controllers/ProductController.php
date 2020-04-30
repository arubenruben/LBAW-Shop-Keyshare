<?php

namespace App\Http\Controllers;

use App\ActiveOffer;
use App\ActiveProduct;
use App\Category;
use App\Genre;
use App\Platform;
use App\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class ProductController extends Controller
{
    public function getHomepageData(){

        $numberResults=5;

        $homepageData['mostPopulars']=$this->getMostPopularProducts($numberResults);
        $homepageData['mostRecents']=$this->getMostRecentProducts($numberResults);

        return $homepageData;
    }

    private function getMostPopularProducts($numberResults){

        /*
        return DB::table('product')
            ->whereNull('discount.start_date')
            ->orwhere(function ($query) {
               $query->whereDate('discount.start_date','<',Carbon::now())
                     ->whereDate('discount.end_date', '>',Carbon::now());
            })
            ->join('active_products','active_products.product_id','=','product.id')
            ->join('offer','offer.product','=','product.id')
            ->join('active_offers','active_offers.offer_id','=','offer.id')
            ->leftJoin('discount','discount.offer','=','offer.id')
            ->join('product_has_platform','product_has_platform.product','=','product.id')
            ->join('platform','platform.id','=','product_has_platform.platform')
            ->orderBy('num_sells')
            ->select('product.name','platform.name','offer.price')
            ->get();
            */

        return DB::select(
            'SELECT products.name AS product_name,platforms.name, min(offers.price) AS min_price, max(num_sells) AS num_sells, max(discounts.rate) AS discount_rate 
                FROM active_products JOIN products ON active_products.product_id=products.id
                    JOIN offers ON offers.product_id=products.id
                    JOIN active_offers ON offers.id=active_offers.offer_id
                    LEFT OUTER JOIN discounts ON discounts.offer_id=offers.id
                    JOIN product_has_platforms pf ON pf.product_id=products.id
                    JOIN platforms ON platforms.id=pf.platform_id
                WHERE (discounts.start_date IS NULL OR (discounts.start_date<now() AND discounts.end_date > now()))	
                GROUP BY product_name,platforms.name
                ORDER BY num_sells DESC
                LIMIT ?',[$numberResults]
        );

    }

    private function getMostRecentProducts($numberResults){

        /*
        return DB::table('product')
            ->whereNull('discount.start_date')
            ->orwhere(function ($query) {
            $query->whereDate('discount.start_date','<',Carbon::now())
                    ->whereDate('discount.end_date', '>',Carbon::now());
            })
            ->join('active_products','active_products.product_id','=','product.id')
            ->join('offer','offer.product','=','product.id')
            ->join('active_offers','active_offers.offer_id','=','offer.id')
            ->leftJoin('discount','discount.offer','=','offer.id')
            ->join('product_has_platform','product_has_platform.product','=','product.id')
            ->join('platform','platform.id','=','product_has_platform.platform')
            ->orderBy('num_sells')
            ->select('product.name','platform.name','offer.price')
            ->get();
            */

        return DB::select(
            'SELECT products.name AS product_name, platforms.name, min(offers.price) AS min_price, max(num_sells) AS num_sells, max(discounts.rate) AS discount_rate, max(products.launch_date)  AS launch_date
                FROM active_products JOIN products On active_products.product_id=products.id
                    JOIN offers ON offers.product_id=products.id
                    JOIN active_offers ON offers.id=active_offers.offer_id
                    LEFT OUTER JOIN discounts ON discounts.offer_id=offers.id
                    JOIN product_has_platforms pf ON pf.product_id=products.id
                    JOIN platforms ON platforms.id=pf.platform_id
                    WHERE (discounts.start_date IS NULL OR (discounts.start_date<now() AND discounts.end_date > now()))
                GROUP BY product_name,platforms.name
                ORDER BY launch_date DESC
                LIMIT ?',[$numberResults]
        );

    }

    public function home(){
        $homepageData=$this->getHomepageData();

        return view('pages.homepage',['data'=>$homepageData,'breadcrumbs' => []]);
    }

    public function search(Request $request){
        $products = Product::all()->filter(function (Product $product){
            return ActiveProduct::find($product->id) !== false;
        });
        $filtered = $this->filterProducts($request, $products);

        $genres = Genre::all();
        $platforms = Platform::all();
        $categories = Category::all();

        $prices = [];
        foreach ($filtered as $product){
            $active_offers = $product->active_offers;
            if($active_offers != null){
                array_push($prices, $active_offers->min(function (ActiveOffer $activeOffer){
                    return $activeOffer->offer->price;
                }));
            }
        }

        if(count($prices) === 0){
            $prices = [0, 100];
        }

        $min_price = min($prices);
        $max_price = max($prices);

        $filtered = $filtered->forPage($request->has('page') ? $request->input('page') : 0, 9);

        return view('pages.products', ['genres' => $genres, 'platforms' => $platforms, 'categories' => $categories,
            'min_price' => $min_price, 'max_price' => $max_price, 'products' => $filtered, 'breadcrumbs' => ['Products' => url('/products/')]]);

    }

    public function get(Request $request){
        $products = Product::all()->filter(function (Product $product){
            return ActiveProduct::find($product->id) !== null;
        });
        $filtered = $this->filterProducts($request, $products);

        $prices = [];
        foreach ($filtered as $product){
            $active_offers = $product->active_offers;
            if($active_offers != null){
                array_push($prices, $active_offers->min(function (ActiveOffer $activeOffer){
                    return $activeOffer->offer->price;
                }));
            }
        }

        if(count($prices) === 0){
            $prices = [0, 100];
        }

        $min_price = min($prices);
        $max_price = max($prices);

        $request->has('page') ? $filtered = $filtered->forPage($request->input('page'), 9) :
            $filtered = $filtered->forPage(0, 9);

        $filtered = $filtered->map(function ($product, $key) {
            return [
                'id' => $product->id, 'name' => $product->name, 'description' => $product->description,
                'launch_date' => $product->launch_date, 'category' => $product->category->name,
                'platforms' => $product->platforms, 'genres' => $product->genres,
                'price' => $product->active_offers->min(function (ActiveOffer $activeOffer){
                    return $activeOffer->offer->price;
                }), 'image' => asset('/images/games/'.$product->image->url)
            ];
        });

        return response()->json(['products' => array_values($filtered->toArray()), 'max_price' => $max_price, 'min_price' => $min_price]);
    }

    public function show($productId, $platform){

    }

    public function offers($productId, $platform){

    }

    private function filterProducts(Request $request, Collection $products) {
        $filter = $products;
        if ($request->has('genres')) {
            $filter = $filter->filter(function(Product $product) use($request) {
                $decoded = explode(",", $request->input('genres'));
                $genres = $product->genres->map(function ($genre, $key) {
                    return $genre->name;
                });
                return count(array_intersect($decoded, $genres->toArray())) == count($decoded);
            });
        }

        if ($request->has('platform')) {
            $filter = $filter->filter(function(Product $product) use($request) {
                foreach ($product->platforms as $platform)
                    if($platform->name == $request->input('platform'))
                        return true;

                return false;
            });
        }

        if ($request->has('category')) {
            $filter = $filter->filter(function(Product $product) use($request) {
                return $product->category->name == $request->input('category');
            });
        }

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
            } else if($request->input('sort_by') === 'Highest Price') {
                $filter = $filter->sortByDesc(function (Product $product){
                    return $product->offers()->min('price');
                });
            } else if($request->input('sort_by') === 'Lowest Price') {
                $filter = $filter->sortBy(function (Product $product){
                    return $product->offers()->min('price');
                });
            }
        }

        return $filter;
    }

    private function idk(){
        $input = Input::get('input');
        $products = Product::whereRaw('name_tsvector @@ plainto_tsquery('.$input.')')->paginate(9);
        return view('pages.products', ['products' => $products, 'pages' => array('Products'), 'links'=>array(url('/products/'))]);
    }
}
