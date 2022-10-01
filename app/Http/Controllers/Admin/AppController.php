<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AppCreateRequest;
use Illuminate\Support\Facades\Storage;

class AppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perpage = $request->input('perPage') ?: 10;
        $query = App::query();
        $query->when($request->input('search'), function($query, $search){
            $query->where('app_key','like', "%{$search}%");
            $query->orWhere('title_en','like', "%{$search}%");
            $query->orWhere('title_pt','like', "%{$search}%");
            $query->orWhere('description_en','like', "%{$search}%");
            $query->orWhere('description_pt','like', "%{$search}%");
        });
        $query->when($request->input('field'), function($query, $field){
            $query->orderBy($field, request('direction'));
        });

        $apps = $query->paginate($perpage)->withQueryString();

        return inertia('Apps/Index', [
            'apps' => $apps,
        ]);
    }


    public function home(Request $request, $app_key,$title_en)
    {
        $new_file = $app_key.'.vue';
        $exists = Storage::disk('VueFiles')->exists($new_file);
        if(!$exists){
            $created = Storage::disk('VueFiles')->copy('DefaultHome.vue',$new_file);
            if(!$created){
                return redirect()->back()->with([
                    'message' => 'Something Error',
                    'type' => 'error'
                ]);
            }
        }

        $title = $title_en;
        return inertia('Apps/Home/'.$app_key, [
            'title' => $title,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AppCreateRequest $request)
    {
        $image_path = '';

        try{
            if ($request->hasFile('image')) {
                $image_path = $request->file('image')->store('Root/Apps/Images', 'public');
            }
            App::create([
                'app_key' => $request->app_key,
                'title_en' => $request->title_en,
                'title_pt' => $request->title_pt,
                'description_en' => $request->description_en,
                'description_pt' => $request->description_pt,
                'image' => $image_path,
            ]);

            return redirect()->back()->with([
                'message' => 'App Created Successfully',
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
     * @param  \App\Models\Admin\App  $app
     * @return \Illuminate\Http\Response
     */
    public function show(App $app)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\App  $app
     * @return \Illuminate\Http\Response
     */
    public function edit(App $app)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\App  $app
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, App $app)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\App  $app
     * @return \Illuminate\Http\Response
     */
    public function destroy(App $app)
    {
        //
    }

    public function changeStatus(Request $request){
        $row = App::where('id',$request->app_id)->update(
            ['active' => $request->status == "true" ? true : false ]
        );
        if($row){
            return redirect()->back()->with([
                'message' => 'App Status Updated Successfully',
                'type' => 'success'
            ]);
        }

    }
}
