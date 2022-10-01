<?php

namespace App\Http\Requests\Admin;

use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Http\FormRequest;

class GroupDeleteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $role = Role::findByName(auth()->user()->getCurrentRoleName());
        return $role->hasPermissionTo('Delete Group');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'group_id' => 'required'
        ];
    }
}
