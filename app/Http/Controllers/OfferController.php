<?php

namespace App\Http\Controllers;

use App\ActiveProduct;
use App\Discount;
use App\Http\Requests\OfferAddRequest;
use App\Key;
use App\Offer;
use App\Platform;
use App\Product;
use App\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Policies\OfferPolicy;

use Illuminate\Http\Request;


class OfferController extends Controller
{
    public function show() {
        try {
            $this->authorize('unbanned', Offer::class);
        } catch (AuthorizationException $e) {
            return redirect(url('/'));
        }

        $active_products = ActiveProduct::all()->map(function ($active_product) {
            $product = $active_product->product;
            $platforms = $product->platforms->map(function (Platform $platform){
                return (object)[
                    'id' => $platform->id,
                    'name' => $platform->name,
                    ];
            });

            return (object)[
                'id' => $product->id,
                'name' => $product->name,
                'image' => $product->picture->url,
                'platforms' => $platforms
                ];
        });

        return view('pages.offer.add', ['products' => $active_products, 'breadcrumbs' => ['Add Offer' => url('/offer')]]);
    }

    public function add(OfferAddRequest $request) {
        $offer = Offer::create([
            'user_id' => Auth::id(),
            'product_id' => $request->get('product'),
            'platform_id' => $request->get('platform'),
            'price' =>  $request->get('price')
        ]);

        $offer->save();

        $keys = $request->get("keys");
        $keysCreated = [];
        foreach ($keys as $key){
            Key::create([
                'key' => $key,
                'offer_id' => $offer->id
            ])->save();
        }

        $discounts = $request->get("discounts");
        $discountsCreated = [];
        foreach ($discounts as $discount){
            Discount::create([
                'offer_id' => $offer->id,
                'rate' => $discount['rate'],
                'start_date' => $discount['start'],
                'end_date' => $discount['end']
            ])->save();
        }

        $username = Auth::user()->username;

        return response(url("user/${username}/offers"));
    }

    public function showOffer($offerId) {
        $offer = Offer::findOrFail($offerId);

        try {
            $this->authorize('seller', $offer);
            $this->authorize('unbanned', Offer::class);
        } catch (AuthorizationException $e) {
            return response("You can't view this offer", 401);
        }

        $curName = Auth::user()->username;
        return view('pages.offer.edit', ['offer' => $offer, 'breadcrumbs' => ['User' => url("/user/${curName}/offers"), 'Offers' => url("/user/${curName}/offers"), 'Edit Offer' => url()->current()]]);
    }

    public function update($offerId) {

    }

    public function delete($offerId) {
        $offer = Offer::findOrFail($offerId);

        try {
            $this->authorize('seller', $offer);
        } catch (AuthorizationException $e) {
            return response("You can't delete this offer", 401);
        }

        $offer->final_date = date("Y-m-d");
        $offer->save();

        $response=['profit'=>$offer->profit];
        
        return response(200);
    }

    public function getKeys($offerId) {
        $offer = Offer::findOrFail($offerId);

        try {
            $this->authorize('seller', $offer);
        } catch (AuthorizationException $e) {
            return response('User does not have permissions to add a discount to this offer.', 401);
        }

        return response()->json(['keys' => $offer->keys]);
    }

    public function addKey($offerId) {

    }

    public function getDiscounts($offerId) {
        $offer = Offer::findOrFail($offerId);

        try {
            $this->authorize('seller', $offer);
        } catch (AuthorizationException $e) {
            return response('User does not have permissions to add a discount to this offer.', 401);
        }

        return response()->json(['discounts' => $offer->discounts]);
    }

    public function addDiscount($offerId) {

    }
}