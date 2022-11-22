<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
            'title' => 'required',
            'short_title' => 'required',
            'is_free' => 'required',
            'type' => 'required',
            'is_active' => 'required',
            'pre_login' => 'required',
            'details' => 'nullable',
            'expiry_date' => 'nullable|date',
            'stock_id' => 'required',
            'status' => 'required',
            'price' => 'required',
            'real_price' => 'required',
            'quantity' => 'required|numeric',
        ];
    }
}
