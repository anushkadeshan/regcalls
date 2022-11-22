<?php

namespace App\Http\Controllers\Admin\Ecommerce;

use App\Models\Category;
use App\Models\Attribute;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Http\Controllers\Controller;
use App\Models\Apps\Ecommerce\Stock;
use App\Models\Apps\Ecommerce\Product;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\ProductCreateRequest;
use App\Http\Requests\Admin\ProductUpdateRequest;

class ProductController extends Controller
{
    public function index(Request $request){
        $perpage = $request->input('perPage') ?: 10;
        $query = Product::query();
        $query->when($request->input('search'), function($query, $search){
            $query->where('title','like', "%{$search}%");
            $query->orWhere('short_title','like', "%{$search}%");
            $query->orWhere('details','like', "%{$search}%");
        });
        $query->when($request->input('field'), function($query, $field){
            $query->orderBy($field, request('direction'));
        });

        $products = $query->paginate($perpage)->withQueryString();


        return inertia('Apps/Ecommerce/Products/Products', [
            'products' => $products,
        ]);
    }

    public function create(){
        //dd($categories->toArray());
        $categories = Category::pluck('name','id')->toArray();
        $attributes = Attribute::get();
        $stocks = Stock::where('is_active',true)->where('status','Approved')->get();
        return inertia('Apps/Ecommerce/Products/ProductsCreate', [
            'categories' => $categories,
            'attributes' => $attributes,
            'stocks' => $stocks
        ]);
    }

    public function store(ProductCreateRequest $request){
        try{
            $product = Product::create([
                'code' => $request->code,
                'title' => $request->title,
                'short_title' => $request->short_title,
                'is_free' => $request->is_free,
                'type' => $request->type,
                'is_active' => $request->is_active,
                'pre_login' => $request->pre_login,
                'main_image' => ProductService::saveMainImage($request),
                'images' => ProductService::saveOtherImages($request),
                'tech_specs' => ProductService::saveTechSpecs($request),
                'details' => $request->details,
                'downloads' => ProductService::saveDownloads($request),
                'price' => $request->price,
                'real_price' => $request->real_price,
                'quantity' => $request->quantity,
                'expiry_date' => $request->expiry_date,
                'stock_id' => $request->stock_id,
                'added_by' => $request->added_by,
                'status' => $request->status,
            ]);

            ProductService::createAttributes($request->input('attributes'),$product);
            ProductService::createCategories($request->input('categories'),$product);

            return redirect()->back()->with([
                'message' => 'Product Added Successfully',
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

    public function edit($id){
        $product = Product::with('attributes','categories')->findOrFail($id);
        $product_categories = $product->categories->pluck('id')->toArray();
        $product_attributes = $product->attributes->map(function($attribute, $key) {
            return [
                'attribute_name' => $attribute->name,
                'value' => $attribute->pivot->value
            ];
        });
        $product_attributes_ids = $product->attributes->pluck('name')->toArray();

        $categories = Category::pluck('name','id')->toArray();
        $attributes = Attribute::get();
        $stocks = Stock::where('is_active',true)->where('status','Approved')->get();
        return inertia('Apps/Ecommerce/Products/ProductEdit', [
            'product' => $product,
            'categories' => $categories,
            'attributes' => $attributes,
            'stocks' => $stocks,
            'product_categories' => $product_categories,
            'product_attributes' => $product_attributes,
            'product_attributes_ids' => $product_attributes_ids
        ]);
    }

    public function update(ProductUpdateRequest $request){
        try{
            Product::where('id',$request->product_id)->update($request->validated());
            $product = Product::find($request->product_id);

            ProductService::createAttributes($request->input('attributes'),$product);
            ProductService::createCategories($request->input('categories'),$product);
            return redirect()->back()->with([
                'message' => 'Product updated Successfully',
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

    public function uploadDownloads(Request $request){
        try{
            $request->validate([
                'downloads' => 'required',
            ]);
            $product = Product::find($request->product_id);
            $folder_name = str_pad(session('group_id'), 4, '0', STR_PAD_LEFT);
            $exsisting_downloads_array = $product->downloads;
            foreach($request->downloads as $downlod){
                $file_path = $downlod->store($folder_name.'/apps/ecommerce/downloads', 'public');
                array_push($exsisting_downloads_array, $file_path);
            }
            $product->downloads = $exsisting_downloads_array;
            $product->save();

            return redirect()->back()->with([
                'message' => 'New Downloads Added Successfully',
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

    public function deleteDownloads(Request $request){
        try{
            $product = Product::find($request->product_id);
            $exsisting_downloads_array = $product->downloads;
            $key = array_search($request->file_name,$exsisting_downloads_array);
            unset($exsisting_downloads_array[$key]);
            $product->downloads = $exsisting_downloads_array;
            $product->save();

            //delete file
            Storage::disk('public')->delete($request->file_name);

            return redirect()->back()->with([
                'message' => 'Deleted Successfully',
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

    public function uploadTechSpecs(Request $request){
        try{
            $request->validate([
                'tech_specs' => 'required',
            ]);
            $product = Product::find($request->product_id);
            $current_file = $product->tech_specs;
            $folder_name = str_pad(session('group_id'), 4, '0', STR_PAD_LEFT);
            $file_path = $request->file('tech_specs')->store($folder_name.'/apps/ecommerce/tec_specs', 'public');

            $product->tech_specs = $file_path;
            $product->save();

            //delete file
            Storage::disk('public')->delete($current_file);

            return redirect()->back()->with([
                'message' => 'New Tech Specs Added Successfully',
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

    public function uploadMainImage(Request $request){
        try{
            $request->validate([
                'main_image' => 'required|max:4096',
            ]);
            $product = Product::find($request->product_id);
            $current_file = $product->main_image;
            $folder_name = str_pad(session('group_id'), 4, '0', STR_PAD_LEFT);
            $file_path = $request->file('main_image')->store($folder_name.'/apps/ecommerce/main_images', 'public');

            $product->main_image = $file_path;
            $product->save();

            //delete file
            Storage::disk('public')->delete($current_file);

            return redirect()->back()->with([
                'message' => 'New Main Image Added Successfully',
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

    public function uploadOtherImages(Request $request){
        try{
            $request->validate([
                'images' => 'required|max:4096',
            ]);
            $product = Product::find($request->product_id);
            $current_file = $product->main_image;
            $folder_name = str_pad(session('group_id'), 4, '0', STR_PAD_LEFT);
            $exsisting_images_array = $product->downloads;
            foreach($request->images as $file){
                $file_path = $file->store($folder_name.'/apps/ecommerce/other_images', 'public');
                array_push($exsisting_images_array, $file_path);
            }
            $product->images = $exsisting_images_array;
            $product->save();

            return redirect()->back()->with([
                'message' => 'Images Added Successfully',
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

    public function deleteImage(Request $request){
        try{
            $product = Product::find($request->product_id);
            $exsisting_images_array = $product->images;
            $key = array_search($request->file_name,$exsisting_images_array);

            unset($exsisting_images_array[$key]);
            //dd($exsisting_images_array,$request->file_name,$key);
            $product->images = $exsisting_images_array;
            $product->save();

            //delete file
            Storage::disk('public')->delete($request->file_name);

            return redirect()->back()->with([
                'message' => 'Deleted Successfully',
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
