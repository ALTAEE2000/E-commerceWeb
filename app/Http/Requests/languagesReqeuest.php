<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class languagesReqeuest extends FormRequest
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
            'name' => 'required|string|max:100',
            'abbr' => 'required|max:10',
            'active' => 'in:0,1',
            'direction' => 'required|in:rtl,ltr',

        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'name is very required',
            'abbr.required' => 'this is required',
            'active.required' => 'this fields is required',
            'direction.required' => 'this is very required',

            'name.string' => 'name should be string',
            'name.max' => 'dont be max long 100',
            'active.in' => 'the number  is not correct',

            'abbr.max' => 'this is should be increase more than 10',



        ];
    }
}
