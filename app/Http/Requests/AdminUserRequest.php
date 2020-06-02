<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
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
            'query' => "sometimes | string",
            'page' => "sometimes | integer | min:0"
        ];
    }

    /**
     * Get the validation fail messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'query.string' => "Query given must be a string",
            'page.integer' => "Page given must be an integer",
            'page.min' => "page given must be equal or higher than 0",
        ];
    }
}
