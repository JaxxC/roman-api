<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConvertNumber extends FormRequest
{
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
            'number' => 'required|integer|min:1|max:3999'
        ];
    }

    public function messages()
    {
        return [
            'number.required' => 'A number is required',
            'number.integer'  => 'Number must be an integer between 1 - 3999',
            'number.min'  => 'Number must be an integer between 1 - 3999',
            'number.max'  => 'Number must be an integer between 1 - 3999'
        ];
    }
}
