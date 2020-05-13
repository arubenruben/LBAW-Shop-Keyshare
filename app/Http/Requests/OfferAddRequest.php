<?php

namespace App\Http\Requests;

use App\ActiveProduct;
use App\Platform;
use App\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class OfferAddRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return Auth::check() && !Auth::user()->isBanned();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'product' => "bail | required | numeric | exists:active_products,product_id",
            'platform' => "bail | required | numeric | exists:platforms,id",
            'discounts' => 'bail | sometimes | array',
            'keys' => 'bail | required | array | filled | distinct',
        ];
    }

    /**
     * Get the validation fail messages that apply to the request.
     *
     * @return array
     */
    public function messages() {
        return [
            'product.required' => 'Please select a product.',
            'product.numeric' => 'The product passed must be the id of the product.',
            'product.exists' => 'The product does not exist in the website or is not available for selling.',
            'platform.required' => 'Please select a platform.',
            'platform.numeric' => 'The platform passed must be the id of the platform.',
            'platform.exists' => 'The platform does not exist in the website.',
            'discounts.array' => 'The discounts given must be in an array.',
            'keys.required' => 'The offer must have keys.',
            'keys.array' => 'The keys given must be in an array.',
            'keys.filled' => 'The keys array must not be empty.',
            'keys.distinct' => 'The keys passed must be all distinct from one another.',
        ];
    }
}
