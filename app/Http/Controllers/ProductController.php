<?php

namespace App\Http\Controllers;

use App\ActiveOffer;
use App\ActiveProduct;
use App\Category;
use App\Genre;
use App\Offer;
use App\Platform;
use App\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;

use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    private function getProducts() : \Illuminate\Support\Collection {
        $filtered = $products = Product::all()->filter(function (Product $product){
            return ActiveProduct::find($product->id) !== null;
        });

        return $filtered->map(function (Product $product) {
            $lowest_price = $product->offers->min('price');
            $lowest_offer = $product->offers->where('price', $lowest_price)->first();
            $discount = $lowest_offer->active_discount();
            return (object)[
                'name' => $product->name,
                'picture' => asset('/pictures/games/'.$product->picture->url),
                'platform' =>$lowest_offer->platform->only(['name']),
                'min_price' => '$'.$lowest_price,
                'discount_rate' => $discount !== null ? $discount->rate : null,
                'num_sells' => $product->num_sells,
                'launch_date' => $product->launch_date,
            ];
        });
    }

    public function home(){
        
        $numberResults = 5;

        $homepageData = collect([
            'mostPopulars' => $this->getProducts()->sortByDesc('num_sells')->forPage(0, $numberResults),
            'mostRecents' => $this->getProducts()->sortByDesc('launch_date')->forPage(0, $numberResults),
            'carousel'=>[asset('pictures/carousel/1.png'),asset('pictures/carousel/2.png'),asset('pictures/carousel/3.png')]
        ]);

        return view('pages.homepage.homepage',['data'=>$homepageData->all(),'breadcrumbs' => []]);
    }

    public function search(Request $request){
        $products = Product::all()->filter(function (Product $product){
            return ActiveProduct::find($product->id) !== null;
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
                }), 'picture' => asset('/images/games/'.$product->image->url)
            ];
        });

        return response()->json(['products' => array_values($filtered->toArray()), 'max_price' => $max_price, 'min_price' => $min_price]);
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

    public function offers($productId, $platform){
        return;
    }


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
    
        return view('pages.products.product', ['user' => Auth::user(), 'product' => $product, 'platformName' => $platformName, 'offers' => $offers, 'breadcrumbs' => ['Product' => url('/product/')]]);
    }
}
