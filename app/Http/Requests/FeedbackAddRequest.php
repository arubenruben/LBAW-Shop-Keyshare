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
    public function authorize()
    {
        //return Auth::check() && !Auth::user()->isBanned() && Auth::user()->id == $key->order->user_id;
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
            'key' => "bail | required | filled | string | exists:keys,id",
            'comment' => "bail | required | filled | string",
            'evaluation' => "bail | required | filled | boolean"
        ];
    }

    /**
     * Get the validation fail messages that apply to the request.
     *
     * @return array
     */
    public function messages() {
        return [
            'evaluation.required' => 'Didn\'t give a feedback evaluation',
            'evaluation.filled' => 'Didn\'t give a feedback evaluation',
            'evaluation.boolean' => 'Evaluation is invalid',
            'comment.required' => 'Didn\'t give a feedback comment',
            'comment.filled' => 'Didn\'t give a feedback comment',
            'comment.string' => 'Comment is invalid',
            'key.required' => 'Feedback is invalid',
            'key.filled' => 'Feedback is invalid',
            'key.string' => 'Feedback is invalid',
            'key.exists' => 'Feedback is invalid'
        ];
    }
}