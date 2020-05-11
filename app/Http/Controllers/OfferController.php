<?php

namespace App\Http\Controllers;

use App\ActiveProduct;
use App\Http\Requests\OfferAddRequest;
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

    }

    public function showOffer($offerId) {

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