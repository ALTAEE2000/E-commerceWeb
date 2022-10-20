<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MainCateRequest extends FormRequest
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
            'photo' => 'required|mimes:png,jpg,jpeg', //mimes it means images\
            // 'category' => 'required|array|min::1',
            'category.*.name' => 'required',
            'category.*.abbr' => 'required',
            'category.*.active' => 'required',


        ];
    }

    // public function messages()
    // {
    //     return [
    //         'name.required' => 'name is very required',
    //         'abbr.required' => 'this is required',
    //         'active.required' => 'this fields is required',
    //         'direction.required' => 'this is very required',

    //         'name.string' => 'name should be string',
    //         'name.max' => 'dont be max long 100',
    //         'active.in' => 'the number  is not correct',

    //         'abbr.max' => 'this is should be increase more than 10',



    //     ];
    // }
}
