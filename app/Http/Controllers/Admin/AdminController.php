<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Order;
use App\Report;
use Illuminate\Support\Facades\View;
use App\Product;

class AdminController extends Controller
{
    



    public function show()
    {
        $active_reports = Report::where('status', '=', 'false');

        $dailyOrders = Order::where('date', '=', 'CURRENT_DATE');

        $dailyKeys = [];
        foreach ($dailyOrders as $dailyOrder) {
            foreach ($dailyOrder->keys as $key) {
                array_push($dailyKeys, $key);
            }
        }

        $dailyKeysCollection = collect($dailyKeys);

        $monthlyOrders = Order::where('date', '>=', 'cast(date_trunc(\'month\', CURRENT_DATE) as date)');

        $monthlyKeys = [];
        foreach ($monthlyOrders as $monthlyOrder) {
            foreach ($monthlyOrder->keys as $key) {
                array_push($monthlyKeys, $key);
            }
        }

        $monthlyKeysCollection = collect($monthlyKeys);

        return view(
            'admin.pages.homepage',
            [
                'title' => 'Dashboard',
                'contents' => [
                    'Tasks to be done' => ['Active Reports: '.$active_reports->count()],
                    'Daily Statistics' => [
                        'Transactions made: '.$dailyKeysCollection->count(),
                        'Money made: '.$dailyKeysCollection->sum(function ($dailyKey) { return $dailyKey->price; }).' US$'
                    ],
                    'Monthly Statistics' => [
                        'Transactions made: '.$monthlyKeysCollection->count(),
                        'Money made: '.$monthlyKeysCollection->sum(function ($monthlyKey) { return $monthlyKey->price; }).' US$'
                    ]
                ]
            ]
        );
    }

    public function productShow()
    {
        $data=array();

        $products=Product::paginate(10);

        return view('admin.pages.products',['data'=>$products]);
    }

    public function productAdd()
    {
        return "true";

    }

    public function productGet()
    {

    }

    public function productAddForm()
    {
        return view('admin.pages.productAdd');
    }

    public function productUpdateView($id)
    {

    }

    public function productUpdate($id)
    {

    }

    public function productDelete($id)
    {

    }

    public function categoryGet()
    {

    }

    public function categoryShow()
    {

    }

    public function categoryAdd()
    {

    }

    public function categoryUpdate($id)
    {

    }

    public function categoryDelete($id)
    {

    }

    public function genreGet()
    {

    }

    public function genreShow()
    {

    }

    public function genreAdd()
    {

    }

    public function genreUpdate($id)
    {

    }

    public function genreDelete($id)
    {

    }

    public function platformGet()
    {

    }

    public function platformShow()
    {

    }

    public function platformAdd()
    {

    }

    public function platformUpdate($id)
    {

    }

    public function platformDelete($id)
    {

    }

    public function userGet()
    {

    }

    public function userShow()
    {

    }

    public function userUpdate($id)
    {

    }

    public function reportGet()
    {

    }

    public function reportShow()
    {

    }

    public function reportShowMessages($id)
    {

    }

    public function reportMessage($id)
    {

    }

    public function transactionGet()
    {

    }

    public function transactionShow()
    {

    }

    public function feedbackGet()
    {

    }

    public function feedbackShow()
    {

    }

    public function feedbackDelete($id)
    {

    }

    public function faqGet()
    {

    }

    public function faqShow()
    {

    }

    public function faqAdd()
    {

    }

    public function faqUpdate($id)
    {

    }

    public function faqDelete($id)
    {

    }
    public function __construct()
    {
        $this->middleware('auth:admin');

        View::share('nav', 'dashboard');
    }

}