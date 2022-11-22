<?php

namespace App\Services;

use App\Models\Attribute;
use Illuminate\Support\Facades\DB;

class ProductService{
    public static function saveTechSpecs($request){
        $folder_name = str_pad(session('group_id'), 4, '0', STR_PAD_LEFT);
        if($request->hasFile('tech_specs')) {
            $file_path = $request->file('tech_specs')->store($folder_name.'/apps/ecommerce/tec_specs', 'public');
            return $file_path;
        }
        return null;

    }

    public static function saveDownloads($request){
        $folder_name = str_pad(session('group_id'), 4, '0', STR_PAD_LEFT);
        if($request->hasFile('downloads')) {
            $file_paths = [];
            foreach($request->file('downloads') as $file){
                $file_path = $file->store($folder_name.'/apps/ecommerce/downloads', 'public');
                $file_paths[] =$file_path;
            }
            return $file_paths;
        }
        return [];

    }

    public static function saveMainImage($request){
        $folder_name = str_pad(session('group_id'), 4, '0', STR_PAD_LEFT);
        if($request->hasFile('main_image')) {
            $file_path = $request->file('main_image')->store($folder_name.'/apps/ecommerce/main_images', 'public');
            return $file_path;
        }
        return null;

    }

    public static function saveOtherImages($request){
        $folder_name = str_pad(session('group_id'), 4, '0', STR_PAD_LEFT);
        if($request->hasFile('images')) {
            $file_paths = [];
            foreach($request->file('images') as $file){
                $file_path = $file->store($folder_name.'/apps/ecommerce/other_images', 'public');
                $file_paths[] =$file_path;
            }
            return $file_paths;
        }
        return [];

    }

    public static function createAttributes($attributes,$product){
        if(!empty($attributes)){
            $processed_attributes = [];
            foreach($attributes as $attribute){
                $attribute_object = Attribute::where('name',$attribute['attribute_name'])->first('id');
                $processed_attributes[] = ['value'=> $attribute['value'],'attribute_id' => $attribute_object->id];
            }
            DB::connection('template')->table('attribute_values')->where('product_id',$product->id)->delete();
            foreach($processed_attributes as $pa){
                $product->attributes()->attach($pa['attribute_id'],['value'=>$pa['value']]);
            }
        }
    }

    public static function createCategories($categories,$product){
        if(!empty($categories)){
            DB::connection('template')->table('product_categories')->where('product_id',$product->id)->delete();
            foreach($categories as $category){
                $product->categories()->attach($category);
            }
        }
    }
}
