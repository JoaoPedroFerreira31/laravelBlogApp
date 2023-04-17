<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'email' => 'required|string',
            'name' => 'required|string',
            'first_name' => 'nullable|string',
            'last_name' => 'nullable|string',
            'dob' => 'nullable|date',
            'website' => 'nullable|string',
            'country' => 'nullable|string',
            'company' => 'nullable|string',
            'description' => 'nullable|string',
            'image' => 'nullable|file|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ];
    }
}
