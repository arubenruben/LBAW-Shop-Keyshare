<?php

namespace App\Http\Controllers;

use App\Discount;

class DiscountController extends Controller
{
    public function update($offerId, $discountId)
    {

    }

    public function delete($discountId) {
        $discount = Discount::findOrFail($discountId);
        $this->authorize('delete', $discount);
        $discount->delete();
    }
}