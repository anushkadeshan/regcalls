<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Admin\Group;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserDeleteRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perpage = $request->input('perPage') ?: 10;
        $query = User::query();
        $query->when($request->input('search'), function($query, $search){
            $query->where('name','like', "%{$search}%");
            $query->orWhere('email','like', "%{$search}%");
            $query->orWhere('phone','like', "%{$search}%");
        });
        $query->when($request->input('field'), function($query, $field){
            $query->orderBy($field, request('direction'));
        });

        $users = $query->paginate($perpage)->withQueryString();
        return inertia('Users/Index', [
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::with('groups')->findOrFail($id);
        $assignedProfiles = $user->profiles()->wherePivot('group_id',session('group_id'))->get()->toArray();
        $profiles = Role::select('id','name')->get();
        $groups = Group::select('id','name')->get();
        return inertia('Users/Edit', [
            'user' => $user,
            'profiles' => $profiles,
            'groups' => $groups,
            'assignedProfiles' => $assignedProfiles
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserDeleteRequest $request)
    {
        try{
            if($request->user_id==1){
                return redirect()->back()->with([
                    'message' => 'You can not delete Primary Super Admin Account',
                    'type' => 'error'
                ]);
            }
            User::destroy($request->user_id);

            return redirect()->back()->with([
                'message' => 'User Deleted Successfully',
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

    public function changeStatus(Request $request){
        $row = User::where('id',$request->user_id)->update(
            ['isActive' => $request->status == "true" ? true : false ]
        );
        if($row){
            return redirect()->back()->with([
                'message' => 'User Status Updated Successfully',
                'type' => 'success'
            ]);
        }

    }

    public function assignGroupsToUser(Request $request){
        try{
            $user = User::findOrFail($request->user_id);

            //assing groups
            $user->groups()->syncWithoutDetaching($request->group_id);

            //assign user role to group
            $user->attachRoleAndGroup('User',$request->group_id);

            return redirect()->back()->with([
                'message' => 'Group Assigned Successfully',
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

    public function removeGroups(Request $request){
        try{
            $user = User::findOrFail($request->user_id);
            $user->groups()->detach($request->group_id);
            return redirect()->back()->with([
                'message' => 'Group Removed Successfully',
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

    public function assignProfileToUser(Request $request){
        try{
            $user = User::findOrFail($request->user_id);
            $user->attachRoleAndGroup((int)$request->role_id,session('group_id'));
            return redirect()->back()->with([
                'message' => 'Profile Assigned Successfully',
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

    public function removeProfiles(Request $request){
        try{
            $user = User::findOrFail($request->user_id);
            $user->detachRoleAndGroup($request->role_id,session('group_id'));
            return redirect()->back()->with([
                'message' => 'Profile Removed Successfully',
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

    public function changeProfile(Request $request){
        session(['current_profile_id' => $request->role_id]);
        return redirect()->back()->with([
            'message' => 'Profile Changed Successfully',
            'type' => 'success'
        ]);
    }
}
