<?php

namespace App\Http\Controllers;

use http\Client\Curl\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserEditRequest;

class UserController extends Controller
{
    public function show($username) {
        $user = DB::table('regular_user')->where('username', $username);

        try {
            //$this->authorize('ownUser', $user->id);
        } catch (AuthorizationException $e) {
            return view('pages.user.profile', ['user' => $user, 'canEdit' => false]);
        }

        return view('pages.user.profile', ['user' => $user, 'canEdit' => true]);
    }

    public function showPurchases() {
        try {
            $this->authorize('loggedIn');
        } catch (AuthorizationException $e) {
            return response(json_encode($e->getMessage()), 400);
        }

        $purchases = $this->getPurchases(Auth::id());

        return view('pages.user.purchases', ['$purchases' => $purchases]);
    }

    public function showOffers($username) {
        $user = DB::table('regular_user')->where('username', $username);
        $canEdit = true;

        try {
            $this->authorize('edit', $user->id);
        } catch (AuthorizationException $e) {
            $canEdit = false;
        }

        $pastOffers = $this->getOffers($user->id, false);
        $currOffers = $this->getOffers($user->id, true);

        return view('pages.user.offers', ['pastOffers' => $pastOffers,
            'currOffers' => $currOffers, 'canEdit' => $canEdit]);
    }

    public function showReports() {
        try {
            $this->authorize('loggedIn');
        } catch (AuthorizationException $e) {
            return response(json_encode($e->getMessage()), 400);
        }

        $myReports = $this->getReports(Auth::id(), true);
        $reportsAgainstMe = $this->getReports(Auth::id(), false);

        return view('pages.user.reports', ['myReports' => $myReports,
            'reportsAgainstMe' => $reportsAgainstMe]);
    }

    public function update(UserEditRequest $request) {
        try {
            $this->authorize('update');
        } catch (AuthorizationException $e) {
            return response(json_encode("You can't edit this profile"), 400);
        }

        $request = $request->validated();

        if(isset($request->oldPassword) && isset($request->newPassword)) {
            if(Hash::check($request->oldPassword, Auth::user()->password)) {
                Auth::user()->password = Hash::make($request->newPassword);
            } else {
                return response(json_encode("Old password is incorrect"), 400);
            }
        }

        if(isset($request->email)) {
            Auth::user()->email = $request->email;
        }

        if(isset($request->description)) {
            Auth::user()->description = $request->description;
        }

        if(isset($request->birth_date)) {
            Auth::user()->birth_date = $request->birth_date;
        }

        if(isset($request->paypal)) {
            Auth::user()->birth_date = $request->birth_date;
        }

        if(isset($request->image)) {
            Auth::user()->image = $request->image;
        }

        Auth::user()->save();
    }

    public function delete() {
        try {
            $this->authorize('delete');
        } catch (AuthorizationException $e) {
            return response(json_encode("You can't delete this profile"), 400);
        }

        User::destroy(Auth::id());
    }

    public function deleteImage() {
        try {
            $this->authorize('update');
        } catch (AuthorizationException $e) {
            return response(json_encode("You can't edit this profile"), 400);
        }

        Auth::user()->image = '0';
        Auth::user()->save();
    }

    public function getPurchases($id) {
        return DB::table('orders')
            ->where('orders.buyer', '=', $id)
            ->join('key', 'orders.number', '=', 'key.orders')
            ->join('offer', 'key.offer', '=', 'offer.id')
            ->join('product', 'offer.product', '=', 'product.id')
            ->join('platform', 'offer.platform', '=', 'platform.id')
            ->join('image', 'product.image', '=', 'image.id')
            ->join('regular_user', 'offer.seller', '=', 'regular_user.id')
            ->leftJoin('feedback', 'key.id', '=', 'feedback.key')
            ->leftJoin('report', 'key.id', '=', 'report.key')
            ->orderBy('orders.date')
            ->select('product.name as product_name', 'regular_user.username as seller_username',
                'orders.date as buying_date', 'key.price_sold as price', 'regular_user.id as seller_id',
                'key.key as key', 'feedback.id as feedback_id', 'report.id as report_id')
            ->get();
    }

    public function getOffers($id, $curr=true) {
        if($curr) {
            return DB::table('offer')
                ->where('offer.seller', '=', $id)
                ->join('active_offers', 'offer.id', '=', 'active_offer.offer_id')
                ->join('platform', 'offer.platform', '=', 'platform.id')
                ->join('product', 'offer.product', '=', 'product.id')
                ->leftJoin('discount', 'offer.id', '=', 'discount.offer')
                ->orderBy('offer.init_date')
                ->select('offer.id as offer_id', 'product.name as product_name',
                    'offer.stock as offer_stock', 'platform.name as platform',
                    'offer.init_date as start_date','offer.price as offer_price',
                    'discount.rate as discount_rate')
                ->get();
        } else {
            return DB::table('offer')
                ->where('offer.seller', '=', $id)
                ->whereNotIn('offer.id', 'active_offers')
                ->join('active_offer', 'offer.id', '=', 'active_offer.offer_id')
                ->join('platform', 'offer.platform', '=', 'platform.id')
                ->join('product', 'offer.product', '=', 'product.id')
                ->leftJoin('discount', 'offer.id', '=', 'discount.offer')
                ->orderBy('offer.init_date')
                ->select('offer.id as offer_id', 'product.name as product_name',
                    'offer.stock as offer_stock', 'platform.name as platform',
                    'offer.init_date as start_date','offer.price as offer_price',
                    'discount.rate as discount_rate')
                ->get();
        }
    }

    public function getReports($id, $reporter=true) {
        if($reporter) {
            return DB::table('report')
                ->where('report.reporter', '=', $id)
                ->join('key', 'report.key', '=', 'key.id')
                ->join('offer', 'key.offer', '=', 'offer.id')
                ->join('orders', 'key.orders', 'orders.id')
                ->join('product', 'offer.product', '=', 'product.id')
                ->orderBy('report.status')
                ->orderBy('report.date')
                ->select('product.name', 'product.image', 'offer.seller',
                    'offer.platform', 'orders.date as order_date', 'report.date as report_date')
                ->get();
        } else {
            return DB::table('report')
                ->where('report.reportee', '=', $id)
                ->join('key', 'report.key', '=', 'key.id')
                ->join('offer', 'key.offer', '=', 'offer.id')
                ->join('orders', 'key.orders', 'orders.id')
                ->join('product', 'offer.product', '=', 'product.id')
                ->orderBy('report.status')
                ->orderBy('report.date')
                ->select('product.name', 'product.image', 'offer.seller',
                    'offer.platform', 'orders.date as order_date', 'report.date as report_date')
                ->get();
        }
    }
}
