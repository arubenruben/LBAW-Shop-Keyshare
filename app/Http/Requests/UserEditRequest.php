<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserEditRequest extends FormRequest
{
    /**
     * @var mixed
     */

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
            'email' => 'bail | sometimes | required | string | email | max:100',
            'description' => 'bail | sometimes | required | string | ',
            '*password' => 'distinct',
            'oldPassword' => 'bail | sometimes | required',
            'newPassword' => 'bail | sometimes | required | max:100',
            'birth_date' => 'bail | sometimes | required | date',
            'paypal' => 'bail | sometimes | required | ',
            'image' => 'bail | sometimes | required | '
        ];
    }

    public function messages() {
        return [
            'email.required' => 'Before submitting, please write an email'
        ];
    }
}
