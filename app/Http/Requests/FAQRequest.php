<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class FAQRequest extends FormRequest
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
    public function rules()
    {
        return [
            'question' => "bail | required | filled | string",
            'answer' => "bail | required | filled | string",
        ];
    }

    /**
     * Get the validation fail messages that apply to the request.
     *
     * @return array
     */
    public function messages() {
        return [
            'question.required' => 'Please provide a question',
            'question.filled' => 'Please provide a question',
            'question.string' => 'The question must be a text',
            'answer.required' => 'Please provide a answer',
            'answer.filled' => 'Please provide a answer',
            'answer.string' => 'The answer must be a text'
        ];
    }
}
