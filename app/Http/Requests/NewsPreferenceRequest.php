<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsPreferenceRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'id'=>['required','uuid'],
            'source'=>['required'],
            'category'=>'required'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            '*.required' => 'This field is required',
            '*.uuid' => 'Invalid string',
        ];
    }
}
