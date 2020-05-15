<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class DiscountAddRequest extends FormRequest
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
            'start' => "bail | required | filled | date | after:yesterday | size:10",
            'end' => "bail | required | filled | date | after:start | size:10",
            'rate' => 'bail | required | filled | numeric | min:1 | max:99',
        ];
    }

    /**
     * Get the validation fail messages that apply to the request.
     *
     * @return array
     */
    public function messages() {
        return [
            'start.required' => 'The start date must be specified.',
            'start.filled' => 'The start date must be specified.',
            'start.date' => 'The start date must follow the Y-m-d format.',
            'start.after' => 'The start date must be no earlier than today.',
            'start.size' => 'The start date must have year with 4 digits, month and day with 2 digits and be separated by - or /',
            'end.required' => 'The end date must be specified.',
            'end.filled' => 'The end date must be specified.',
            'end.date' => 'The end date must follow the Y-m-d format.',
            'end.after' => 'The end date must be later than the start date.',
            'end.size' => 'The end date must have year with 4 digits, month and day with 2 digits and be separated by - or /',
            'rate.required' => 'The rate must be specified.',
            'rate.filled' => 'The rate must be specified.',
            'rate.numeric' => 'The rate must be a numeric value between 1 and 99.',
            'rate.min' => 'The rate must be a numeric value between 1 and 99.',
            'rate.max' => 'The rate must be a numeric value between 1 and 99.',
        ];
    }
}
