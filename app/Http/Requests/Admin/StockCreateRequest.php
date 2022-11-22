<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StockCreateRequest extends FormRequest
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

    public function prepareForValidation(){
        $this->merge([
            'added_by' => auth()->user()->id,
            'status' => 'WIP'
        ]);
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
            'type' => 'required',
            'availability' => 'required',
            'is_active' => 'required',
            'added_by' => 'required',
            'status' => 'required'
        ];
    }
}
