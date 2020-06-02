<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserEditRequest extends FormRequest
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
    public function rules() {
        return [
            'email' => 'bail | sometimes | string | email | unique:users,email',
            'description' => 'bail | sometimes | string |  max:500 ',
            'oldPassword' => 'bail | sometimes | required_with:newPassword',
            'newPassword' => [ 'bail' , 'sometimes' , 'required_with:oldPassword' , 'string' , 'confirmed', 'min:6' , 'max:100' , 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/u'],
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
            'newPassword.regex' => "<p>The password needs to contains characters from this categories:</p>
                <p>* Minimum eight characters</p>
                <p>* At least one uppercase letter </p>
                <p>* One lowercase letter</p>
                <p>* One number and one special character</p>",
            'paypal.string' => 'The paypal email must be a string',
            'paypal.email' => 'The paypal email provided  is not a valid one',
            'image.image' => 'THe image provided is not a valid one'
        ];
    }
}