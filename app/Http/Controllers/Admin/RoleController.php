<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleCreateRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::paginate()->through(fn($role) => [
            'name' => $role->name,
            'guard_name' => $role->guard_name
        ]);
        return inertia('Authorization/Roles', [
            'roles' => $roles,
        ]);
    }

    public function store(RoleCreateRequest $request)
    {
        //dd($request->validated());
        try{
            Role::create($request->validated());
            return redirect()->back()->with([
                'message' => 'Role Created Successfully',
                'type' => 'success'
            ]);
        }
        catch(\Illuminate\Database\QueryException $exception){
            $errorInfo = $exception->errorInfo;
            return redirect()->back()->with([
                'message' => $errorInfo,
                'type' => 'error'
            ]);
        }

    }

}
