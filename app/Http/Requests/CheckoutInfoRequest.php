<?php


namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CheckoutInfoRequest extends FormRequest
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
            'name' => "required | string | regex:/^[A-Za-z\x{00C0}-\x{00FF}][A-Za-z\x{00C0}-\x{00FF}\'\-]+([\ A-Za-z\x{00C0}-\x{00FF}][A-Za-z\x{00C0}-\x{00FF}\'\-]+)*/u",
            'email' => "required | email",
            'address' => 'required | string | max:500',
            'zipcode' => 'required',
            'nonce' => 'required',
            'orderId' => 'required',
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
            'name.required' => "Name is required",
            'name.string' => "Name must be a string",
            'name.regex' => "Name must not contain any numbers or special symbols",
            'email.required' => "Email is required",
            'email.email' => "The provided email is not valid",
            'zipcode.required' => "Zipcode is required",
            'nonce.required' => "Paypal nonce is required, try the checkout again",
            'orderId.required' => "Paypal nonce is required, try the checkout again",
        ];
    }
}
