<?php

namespace App\Http\Controllers\Admin;

use App\BannedUser;
use App\Http\Controllers\Controller;

use App\Http\Requests\AdminBanRequest;
use App\Http\Requests\AdminUserRequest;
use App\Order;
use App\Report;
use App\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\View;

class AdminController extends Controller
{
    public function show() {
        $active_reports = Report::where('status', '=', 'false');

        $daily_orders = Order::where('date', '=', 'CURRENT_DATE');

        $daily_keys = [];
        foreach ($daily_orders as $daily_order) {
            foreach ($daily_order->keys as $key) {
                array_push($daily_keys, $key);
            }
        }

        $daily_keys_collection = collect($daily_keys);

        $monthly_orders = Order::where('date', '>=', 'cast(date_trunc(\'month\', CURRENT_DATE) as date)');

        $monthly_keys = [];
        foreach ($monthly_orders as $monthly_order) {
            foreach ($monthly_order->keys as $key) {
                array_push($monthly_keys, $key);
            }
        }

        $monthly_keys_collection = collect($monthly_keys);

        return view(
            'admin.pages.homepage',
            [
                'title' => 'Dashboard',
                'contents' => [
                    'Tasks to be done' => ['Active Reports: '.$active_reports->count()],
                    'Daily Statistics' => [
                        'Transactions made: '.$daily_keys_collection->count(),
                        'Money made: '.$daily_keys_collection->sum(function ($daily_key) { return $daily_key->price; }).' US$'
                    ],
                    'Monthly Statistics' => [
                        'Transactions made: '.$monthly_keys_collection->count(),
                        'Money made: '.$monthly_keys_collection->sum(function ($monthly_key) { return $monthly_key->price; }).' US$'
                    ]
                ]
            ]
        );
    }

    public function productShow()
    {

    }

    public function productAdd()
    {

    }

    public function productGet()
    {

    }

    public function productForm()
    {

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

    public function userShow(AdminUserRequest $request) {
        if($request->has('query')) {
            $query = implode(':* &', explode(' ', htmlentities($request->input('query'))));
            $users = User::whereRaw("name_tsvector @@ to_tsquery('". $query.":*')")->get();
        } else {
            $users = User::all();
        }

        $page = $request->has('page') ? $request->input('page') : 1;

        $users_paginated = $this->paginate($users, $page);
        $users_paginated->withPath('/admin/user');

        return view('admin.pages.all_users', [
            'title' => 'Users',
            'users' => $users_paginated->items(),
            'query' => ($request->has('query') ? $request->input('query') : ""),
            'links' => $users_paginated->links()
        ]);
    }

    public function userUpdate(AdminBanRequest $request, $id) {
        User::findOrFail($id);

        if($request->input('ban') == "1") {
            if(BannedUser::find($id) === null) {
                BannedUser::create([
                    'id' => $id
                ])->save();
            }
        } else {
            BannedUser::destroy($id);
        }

        return back();
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

    /**
     * Generates a pagination of the items of an array or collection
     *
     * @param array|Collection      $items
     * @param int  $page
     * @param int   $perPage
     * @param array $options
     *
     * @return LengthAwarePaginator
     */
    public function paginate($items, $page = null, $perPage = 10, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}