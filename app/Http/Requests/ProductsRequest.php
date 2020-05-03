<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductsRequest extends FormRequest
{
    /**
     * @var mixed
     */

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'sort' => 'bail | sometimes | digits_between:1,4',
            'genres' => 'bail | sometimes | array',
            'platform' => 'bail | sometimes',
            'category' => 'bail | sometimes',
            'max_price' => 'bail | sometimes',
        ];
    }

    public function messages() {
        return [

        ];
    }
}