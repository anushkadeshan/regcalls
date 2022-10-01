<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class GroupCreateRequest extends FormRequest
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
            'name' => 'filled|max:255',
            'description' => 'filled',
            'address' => 'filled',
            'phone' => 'filled',
            'logo' => 'required|image|mimes:jpeg,jpg,png,gif,svg|max:2048',
            'banner' => 'required|image|mimes:jpeg,jpg,png,gif,svg|max:2048',
        ];
    }
}
