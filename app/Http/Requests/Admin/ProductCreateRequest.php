<?php

namespace App\Http\Requests\Admin;

use App\Models\Apps\Ecommerce\Product;
use Illuminate\Foundation\Http\FormRequest;

class ProductCreateRequest extends FormRequest
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
        $product = Product::latest()->first();
        if(empty($product)){
            $last_id = 1;
        }
        else{
            $last_id = $product->id+1;
        }

        $code = '001G0'.session('group_id').'U0'.auth()->user()->id.'S0'.$this->stock_id.'I0'.$last_id;
        $this->merge([
            'added_by' => auth()->user()->id,
            'status' => 'WIP',
            'code' => $code
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
            'short_title' => 'required',
            'is_free' => 'required',
            'type' => 'required',
            'is_active' => 'required',
            'pre_login' => 'required',
            'main_image' => 'required|max:4096',
            'images' => 'nullable|max:4096',
            'tech_specs' => 'nullable',
            'details' => 'nullable',
            'downloads' => 'nullable',
            'expiry_date' => 'nullable|date',
            'stock_id' => 'required',
            'attributes' => 'nullable',
            'added_by' => 'required',
            'status' => 'required',
            'price' => 'required',
            'real_price' => 'required',
            'quantity' => 'required|numeric',
            'code' => 'required'
        ];
    }
}
