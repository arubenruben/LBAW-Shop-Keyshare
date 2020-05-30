<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
{
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
            'sort' => 'bail | sometimes | integer | between:1,4',
            'genres' => 'bail | sometimes | array',
            'platform' => 'bail | sometimes | string | exists:platforms,name',
            'category' => 'bail | sometimes | string | exists:categories,name',
            'max_price' => 'bail | sometimes | numeric | min:0',
            'query' => 'bail | sometimes | string | max:50 | regex:/^\w+$/u'
        ];
    }
}
