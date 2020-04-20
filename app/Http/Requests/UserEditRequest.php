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
            'email' => 'bail | sometimes | required | string | email | unique:App\User,email',
            'description' => 'bail | sometimes | string |  max:500 ',
            'oldPassword' => 'bail | sometimes | password | required_with:newPassword',
            'newPassword' => 'bail | sometimes | required_with:oldPassword | string | confirmed | min:6 | max:100 | regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\X])(?=.*[!$#%]).*$/',
            'paypal' => 'bail | sometimes | required | string | email',
            'image' => 'bail | sometimes | required | image'
        ];
    }

    public function messages() {
        return [
            'email.required' => 'Before submitting, please write an email',
            'email.unique' => 'The email is already registered under another account',
            'email.string' => 'The email must be a string',
            'email.email' => 'The email provided is not a valid one',
            'description.string' => 'The description must be a string',
            'description.max' => 'The description has a maximum number of 500 characters',
            'oldPassword.required_with' => 'A new password must be sent in conjunction with the old one',
            'newPassword.min' => 'The new password must be over 6 characters',
            'newPassword.max' => 'The new password must be under 100 characters',
            'newPassword.confirmed' => 'The password_confirmation field must be filled',
            'newPassword.regex' => 'The password needs to contains characters from at least three of the following five categories:
                English uppercase characters (A – Z)
                English lowercase characters (a – z)
                Base 10 digits (0 – 9)
                Non-alphanumeric (For example: !, $, #, or %)
                Unicode characters',
            'paypal.string' => 'The paypal email must be a string',
            'paypal.email' => 'The paypal email provided  is not a valid one',
            'image.image' => 'THe image provided is not a valid one'
        ];
    }
}
