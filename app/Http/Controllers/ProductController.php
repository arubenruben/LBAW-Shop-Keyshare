<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function home()
    {
        $homepageData=$this->getHomepageData();

        return view('pages.homepage.homepage',['data'=>$homepageData,'pages'=> array(),'links'=>array()]);
    }

    public function search()
    {

    }

    public function get()
    {

    }

    public function show($productId, $platform)
    {

    }

    public function offers($productId, $platform)
    {

    }
}
