<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Admin;

class ProductAddRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $admin=Auth::user();
        
        Admin::findOrFail($admin->id);

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
            'gameName' => 'bail | required|filled| string | max:100 ',
            'gameGenres' => 'bail | required|filled| string | max:100 ',
            'gamePlatforms' => 'bail | required|filled| string | max:100 ',
            'gameCategories' => 'bail | required|filled| string | max:100 ',
            'gameDescription' => 'bail | required|filled| string | max:5000 ',
            'img-upload' => 'sometimes|nullable',
        ];
    }

    /**
     * Get the validation fail messages that apply to the request.
     *
     * @return array
     */
    public function messages() {
        return [
       
        ];
    }
}