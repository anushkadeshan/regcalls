<?php

namespace App\Http\Controllers\Admin\Ecommerce;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\CategoryCreateRequest;
use App\Http\Requests\Admin\CategoryUpdateRequest;

class CategoryController extends Controller
{
    public function index(Request $request){
        $perpage = $request->input('perPage') ?: 10;
        $query = Category::query()->with('parent');
        $query->when($request->input('search'), function($query, $search){
            $query->where('name','like', "%{$search}%");
            $query->orWhere('slug','like', "%{$search}%");
        });
        $query->when($request->input('field'), function($query, $field){
            $query->orderBy($field, request('direction'));
        });

        $categories = $query->paginate($perpage)->withQueryString();
        $parent_categories = Category::select('id','name')->get();
        return inertia('Apps/Ecommerce/Categories/Categories', [
            'categories' => $categories,
            'parent_categories' => $parent_categories
        ]);
    }

    public function store(CategoryCreateRequest $request){
        try{

            $category = Category::create($request->validated());
            if($request->hasFile('image')){
                if($category->image!=''){
                    //delete file
                    Storage::disk('public')->delete($category->image);
                }
                $folder_name = str_pad(session('group_id'), 4, '0', STR_PAD_LEFT);
                $file_path = $request->file('image')->store($folder_name.'/apps/ecommerce/categories', 'public');
                $category->image = $file_path;
                $category->save();
            }
            return redirect()->back()->with([
                'message' => 'Category Added Successfully',
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

    public function update(CategoryUpdateRequest $request){
        try{
            Category::where('id',$request->id)->update($request->validated());
            if($request->hasFile('image')){
                $category = Category::find($request->id);
                $folder_name = str_pad(session('group_id'), 4, '0', STR_PAD_LEFT);
                $file_path = $request->file('image')->store($folder_name.'/apps/ecommerce/categories', 'public');
                $category->image = $file_path;
                $category->save();
            }
            return redirect()->back()->with([
                'message' => 'Category Updated Successfully',
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
}
