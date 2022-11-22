<?php

namespace App\Http\Controllers\Admin;

use PDO;
use Config;
use App\Models\User;
use App\Models\Admin\App;
use App\Models\Admin\Group;
use Illuminate\Http\Request;
use App\Services\DatabaseService;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\GroupCreateRequest;
use App\Http\Requests\Admin\GroupDeleteRequest;
use App\Http\Requests\Admin\GroupUpdateRequest;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perpage = $request->input('perPage') ?: 10;
        $query = Group::query();
        $query->when($request->input('search'), function($query, $search){
            $query->where('name','like', "%{$search}%");
            $query->orWhere('address','like', "%{$search}%");
            $query->orWhere('description','like', "%{$search}%");
            $query->orWhere('phone','like', "%{$search}%");
        });
        $query->when($request->input('field'), function($query, $field){
            $query->orderBy($field, request('direction'));
        });

        $groups = $query->paginate($perpage)->withQueryString();

        return inertia('Groups/Index', [
            'groups' => $groups,
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
    public function store(GroupCreateRequest $request)
    {

        $logo_path = '';
        $banner_path = '';

        try{
            if ($request->hasFile('logo')) {
                $logo_path = $request->file('logo')->store('Root/Group/Logos', 'public');
            }

            if ($request->hasFile('banner')) {
                $banner_path = $request->file('banner')->store('Root/Group/Banners', 'public');
            }
            Group::create([
                'name' => $request->name,
                'address' => $request->address,
                'description' => $request->description,
                'phone' => $request->phone,
                'logo' => $logo_path,
                'banner' => $banner_path
            ]);

            return redirect()->back()->with([
                'message' => 'Group Created Successfully',
                'type' => 'success'
            ]);

        }
        catch(\Exception $exception){
            $errorInfo = $exception->getMessage();
            return redirect()->back()->with([
                'message' => $errorInfo,
                'type' => 'error'
            ]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $group = Group::with('apps')->findOrFail($id);

        //getting active apps list
        $apps = App::where('active',true)->select('id','title_en')->get();

        return inertia('Groups/Edit', [
            'group' => $group,
            'apps' => $apps
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(GroupUpdateRequest $request)
    {

        $logo_path = '';
        $banner_path = '';
        try{
            $group = Group::findOrFail($request->id);
            if($request->hasFile('logo')) {
                if($group->logo !=''){
                    Storage::disk('public')->delete($group->logo);
                }
                $logo_path = $request->file('logo')->store('Root/Group/Logos', 'public');
                $group->logo = $logo_path;
            }

            if ($request->hasFile('banner')) {
                if($group->banner !=''){
                    Storage::disk('public')->delete($group->banner);
                }
                $banner_path = $request->file('banner')->store('Root/Group/Banners', 'public');
                $group->banner = $banner_path;
            }

            $group->name = $request->name;
            $group->address = $request->address;
            $group->description = $request->description;
            $group->phone = $request->phone;
            $group->save();

            return redirect()->back()->with([
                'message' => 'Group Updated Successfully',
                'type' => 'success'
            ]);

        }
        catch(\Exception $exception){
            $errorInfo = $exception->getMessage();
            return redirect()->back()->with([
                'message' => $errorInfo,
                'type' => 'error'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(GroupDeleteRequest $request)
    {
        try{
            if($request->group_id==1){
                return redirect()->back()->with([
                    'message' => 'You can not delete Primary Group',
                    'type' => 'error'
                ]);
            }
            Group::destroy($request->group_id);

            return redirect()->back()->with([
                'message' => 'Group Deleted Successfully',
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

    public function assignAppsToGroup(Request $request)
    {
        try{
            $group = Group::findOrFail($request->group_id);
            $group->apps()->syncWithoutDetaching($request->app_id);
            return redirect()->back()->with([
                'message' => 'App Assigned Successfully',
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

    public function removeApp(Request $request)
    {
        try{
            $group = Group::findOrFail($request->group_id);
            $group->apps()->detach($request->app_id);
            return redirect()->back()->with([
                'message' => 'App Removed Successfully',
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

    public function changeGroup(Request $request){
        try{
            $role = DB::table('model_has_roles')
            ->where('model_id',auth()->user()->id)
            ->where('group_id',$request->group_id)
            ->first();
            //dd($role->role_id);
            session(['current_profile_id' => $role->role_id]);
            session(['group_id' => $request->group_id]);

            //set current database
            $current_database = 'regcalls_g'.str_pad(session('group_id'), 4, '0', STR_PAD_LEFT);
            session(['database' => $current_database]);

            return redirect()->back()->with([
                'message' => 'Group Changed Successfully',
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
