<?php

namespace App\Http\Requests;

use App\Key;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class FeedbackAddRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize($key)
    {
        return Auth::check() && !Auth::user()->isBanned() && Auth::user()->id == $key->order->user_id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'key' => "bail | required | filled | string | unique:keys,key",
            'comment'=>"required | filled | string"
            'evaluation'=>"required | filled | boolean"
        ];
    }

    /**
     * Get the validation fail messages that apply to the request.
     *
     * @return array
     */
    public function messages() {
        return [
            'key.required' => 'The key must be specified.',
            'key.filled' => 'The key must be specified.',
            'key.string' => 'The key must be a string value.',
            'key.regex' => 'The key must only contain alphabetic characters and digits and can be separated by -, |, \ or /.',
            'key.unique' => 'The key already exists.',
        ];
    }
}