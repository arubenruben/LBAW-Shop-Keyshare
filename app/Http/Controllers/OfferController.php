<?php

namespace App\Http\Controllers;

use App\Offer;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserEditRequest;
use App\Policies\UserPolicy;

use Illuminate\Http\Request;


class OfferController extends Controller
{
    
    public function delete($offerId) {
        $offer = Offer::findOrFail($offerId);

        try {
            $this->authorize('cancel', $offer);
        } catch (AuthorizationException $e) {
            return response(json_encode("You can't delete this offer"), 400);
        }

        $offer->final_date = date("Y-m-d");
        $offer->save();

        $response=['profit'=>$offer->profit];
        
        return response(200);
    }
}
