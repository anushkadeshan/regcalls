<?php

namespace App\Http\Requests\Admin;

use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Http\FormRequest;

class UserDeleteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $role = Role::findByName(auth()->user()->getCurrentRoleName());
        return $role->hasPermissionTo('Delete User');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'user_id' => 'required',
        ];
    }
}
