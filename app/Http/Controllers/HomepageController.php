<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Product;

class HomepageController extends Controller
{

    public function getHomepageData(){

        $homepageData['mostPopulars']=$this->getMostPopularProducts();
        $homepageData['mostRecents']=$this->getMostRecentProducts();   

        return $homepageData;
    }

    private function getMostPopularProducts(){

        $numberResults=10;

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
                'SELECT product.name AS product_name,platform.name, min(offer.price) AS min_price, max(num_sells) AS num_sells, max(discount.rate) AS discount_rate 
                FROM active_products JOIN product ON active_products.product_id=product.id
                    JOIN offer ON offer.product=product.id
                    JOIN active_offers ON offer.id=active_offers.offer_id
                    LEFT OUTER JOIN discount ON discount.offer=offer.id
                    JOIN product_has_platform pf ON pf.product=product.id
                    JOIN platform ON platform.id=pf.platform
                WHERE (discount.start_date IS NULL OR (discount.start_date<now() AND discount.end_date > now()))	
                GROUP BY product_name,platform.name
                ORDER BY num_sells DESC
                LIMIT ?',[$numberResults]
             );
            
    }

    private function getMostRecentProducts(){

        $numberResults=10;

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
                'SELECT product.name AS product_name, platform.name, min(offer.price) AS min_price, max(num_sells) AS num_sells, max(discount.rate) AS discount_rate, max(product.launch_date)  AS launch_date
                FROM active_products JOIN product On active_products.product_id=product.id
                    JOIN offer ON offer.product=product.id
                    JOIN active_offers ON offer.id=active_offers.offer_id
                    LEFT OUTER JOIN discount ON discount.offer=offer.id
                    JOIN product_has_platform pf ON pf.product=product.id
                    JOIN platform ON platform.id=pf.platform
                    WHERE (discount.start_date IS NULL OR (discount.start_date<now() AND discount.end_date > now()))
                GROUP BY product_name,platform.name
                ORDER BY launch_date DESC
                LIMIT ?',[$numberResults]
            );
    
    }


    public function show (Request $request){

        $homepageData=$this->getHomepageData();

        return view('pages.homepage',['data'=>$homepageData,'pages'=> array(),'links'=>array()]);
    }
}
?>