<?php

namespace App\Http\Controllers;

use App\Discount;
use App\Offer;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use App\Policies\DiscountPolicy;

class DiscountController extends Controller
{
    public function update($offerId, $discountId)
    {

    }

    public function delete($discountId) {
        $discount = Discount::findOrFail($discountId);

        try {
            $this->authorize('delete', $discount);
        } catch (AuthorizationException $e) {
            return response("You can't delete this discount", 401);
        }

        $discount->delete();
    }
}