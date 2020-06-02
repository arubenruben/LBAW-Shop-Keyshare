<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class BanAppealRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return Auth::check() && Auth::user()->isBanned() && Auth::user()->banAppeal === null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'appeal' => 'required | string | max:500',
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
            'appeal.required' => "Appeal message is required",
            'appeal.string' => "Appeal message must be a string",
            'appeal.max' => "Appeal message must not have more than 500 letters",
        ];
    }
}
