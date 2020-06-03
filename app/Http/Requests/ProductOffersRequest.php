<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProductOffersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'sort_by' => 'bail | required | filled | integer | between:1,2',
            'all_offers' => 'bail | sometimes | filled | boolean',
        ];
    }

    /**
     * Get the validation fail messages that apply to the request.
     *
     * @return array
     */
    public function messages() {
        return [
            'sort_by.required' => 'Please select a sort option: 1 or 2.',
            'sort_by.integer' => 'The sort option must be either 1 or 2.',
            'sort_by.between' => 'The sort option must be either 1 or 2.',
            'all_offers.boolean' => 'The all parameter must be a boolean.',
        ];
    }
}