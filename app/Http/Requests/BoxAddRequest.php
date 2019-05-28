<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BoxAddRequest extends FormRequest
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
            'title' =>'required',
            'bgcolor' =>'required',
            'link' =>'required',
            'cat' =>'required',
            'type' =>'required',
            'group' =>'required'
        ];

    }
}
