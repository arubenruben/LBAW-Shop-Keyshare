<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ReportAddRequest extends FormRequest
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
            'key' => "bail | required | filled | integer",
            'title' =>"bail | required | filled | string",
            'description' =>"bail | required | filled | string"
        ];
    }

    /**
     * Get the validation fail messages that apply to the request.
     *
     * @return array
     */
    public function messages() {
        return [
            'description.required' => 'Didn\'t give a report description',
            'description.filled' => 'Didn\'t give a report description',
            'description.string' => 'Report description is invalid',
            'title.required' => 'Didn\'t give a report title',
            'title.filled' => 'Didn\'t give a report title',
            'title.string' => 'Report title is invalid',
            'key.required' => 'Feedback is invalid',
            'key.filled' => 'Feedback is invalid',
            'key.string' => 'Feedback is invalid',
            'key.exists' => 'Feedback is invalid'
        ];
    }
}