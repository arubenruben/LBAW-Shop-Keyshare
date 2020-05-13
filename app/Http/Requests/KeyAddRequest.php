<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class KeyAddRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
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
            'key' => "bail | required | filled | string | regex:/^\w+([\-|\\|\/]\w+)*$/g | unique:keys,key",
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
