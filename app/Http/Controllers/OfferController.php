<?php

namespace App\Http\Controllers;

use App\ActiveProduct;
use App\Discount;
use App\Http\Requests\DiscountAddRequest;
use App\Http\Requests\KeyAddRequest;
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
        $user=Auth::user();

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
                'image' => asset('/pictures/games/'.$product->picture->url),
                'platforms' => $platforms,
                ];
        });

        return view('pages.offer.add', ['products' => $active_products,'paypal'=>$user->paypal, 'breadcrumbs' => ['Add Offer' => url('/offer')]]);
    }

    public function add(OfferAddRequest $request) {
        DB::transaction(function () use ($request) {
            $offer = Offer::create([
                'user_id' => Auth::id(),
                'product_id' => $request->get('product'),
                'platform_id' => $request->get('platform'),
                'price' =>  $request->get('price')
            ]);

            $offer->save();

            $keys = $request->get("keys");
            foreach ($keys as $key){
                Key::create([
                    'key' => $key,
                    'offer_id' => $offer->id
                ])->save();
            }

            $discounts = $request->get("discounts");
            foreach ($discounts as $discount){
                Discount::create([
                    'offer_id' => $offer->id,
                    'rate' => $discount['rate'],
                    'start_date' => $discount['start'],
                    'end_date' => $discount['end']
                ])->save();
            }
        });

        $user = Auth::user();
        $username=$user->username;
        
        //UPDATE PAYPAL IF DIFFERENT
        if($request->has('paypal')!==NULL&&strcmp($request->get('paypal'),$user->paypal)!=0){
            $user->paypal=$request->get('paypal');
            $user->save();
        }

        return response(url("user/${username}/offers"));
    }

    public function showOffer($offerId) {
        $offer = Offer::findOrFail($offerId);

        try {
            $this->authorize('unbanned', Offer::class);
            $this->authorize('unfinished', $offer);
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
        
        return redirect('/user/'.Auth::user()->username.'/offers');
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

    public function addKey(KeyAddRequest $request, $offerId) {
        $offer = Offer::findOrFail($offerId);

        try {
            $this->authorize('seller', $offer);
        } catch (AuthorizationException $e) {
            return response('User does not have permissions to add a key to this offer.', 401);
        }
        try {
            $this->authorize('unfinished', $offer);
        } catch (AuthorizationException $e) {
            return response('The offer selected is sold out. You cannot add a key to this offer.', 401);
        }

        $key = Key::create([
            'offer_id' => $offerId,
            'key' => $request->get('key')
        ]);

        return response()->json(['id' => $key->id]);
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

    public function addDiscount(DiscountAddRequest $request, $offerId) {
        $offer = Offer::findOrFail($offerId);

        try {
            $this->authorize('seller', $offer);
        } catch (AuthorizationException $e) {
            return response('User does not have permissions to add a discount to this offer.', 401);
        }
        try {
            $this->authorize('unfinished', $offer);
        } catch (AuthorizationException $e) {
            return response('The offer selected is sold out. You cannot add a discount to this offer.', 401);
        }

        $discount = Discount::create([
            'offer_id' => $offerId,
            'rate' => $request->get('rate'),
            'start_date' => $request->get('start'),
            'end_date' => $request->get('end')
        ]);

        return response()->json(['id' => $discount->id]);
    }
}