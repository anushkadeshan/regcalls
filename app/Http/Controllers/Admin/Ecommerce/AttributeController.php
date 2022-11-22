<?php

namespace App\Http\Controllers\Admin\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    public function index(Request $request){
        $perpage = $request->input('perPage') ?: 10;
        $query = Attribute::query();
        $query->when($request->input('search'), function($query, $search){
            $query->where('name','like', "%{$search}%");
        });
        $query->when($request->input('field'), function($query, $field){
            $query->orderBy($field, request('direction'));
        });

        $attributes = $query->paginate($perpage)->withQueryString();
        return inertia('Apps/Ecommerce/Attributes/Attributes', [
            'attributes' => $attributes,
        ]);
    }

    public function store(Request $request){
        try{
            $validated = $request->validate([
                'name'=>'required|unique:template.attributes,name',
            ]);
            Attribute::create($validated);
            return redirect()->back()->with([
                'message' => 'Attribute Added Successfully',
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

    public function update(Request $request){
        try{
            $validated = $request->validate([
                'name'=>'required',
                'id' => 'required'
            ]);
            Attribute::where('id',$request->id)->update($validated);
            return redirect()->back()->with([
                'message' => 'Attribute updated Successfully',
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
