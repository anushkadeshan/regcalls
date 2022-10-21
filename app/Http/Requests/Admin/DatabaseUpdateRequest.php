<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DatabaseUpdateRequest extends FormRequest
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
            'driver' => 'required',
            'url' => 'nullable',
            'host' => 'required',
            'port' => 'required|numeric',
            'database' => 'required',
            'username' => 'required',
            'password' => 'nullable',
            'unix_socket' => 'nullable',
            'charset' => 'nullable',
            'collation' => 'nullable',
            'prefix' => 'nullable',
            'prefix_indexes' => 'required',
            'strict' => 'required',
            'engine' => 'nullable',
        ];
    }
}
