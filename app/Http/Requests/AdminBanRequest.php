<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminBanRequest extends FormRequest
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
            'ban' => "bail | required | boolean",
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
            'ban.required' => "A value for ban must present and of boolean type",
            'ban.boolean' => "Ban value must be of boolean type",
        ];
    }
}