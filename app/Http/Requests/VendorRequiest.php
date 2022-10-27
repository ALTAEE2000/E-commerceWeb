<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendorRequiest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return TRUE;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'logo' => 'required_without:id|mimes:jpg,jpeg,png|nullable',
            'name' => 'required|string|max:100',
            'mobile' => 'required|max:100',
            'email' => 'sometimes|nullable|email',
            'category_id' => 'required|exists:main_categories,id',
            'address' => 'required|string:max:100',
            //'category.*.active' => 'required',
        ];
    }
}
