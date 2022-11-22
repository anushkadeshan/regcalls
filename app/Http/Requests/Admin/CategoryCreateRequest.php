<?php

namespace App\Http\Requests\Admin;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class CategoryCreateRequest extends FormRequest
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
            'slug' => Str::slug($this->name, '-'),
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
            'name' => 'required',
            'parent_id' => 'nullable',
            'order' => 'required',
            'slug' => 'required'
        ];
    }
}
