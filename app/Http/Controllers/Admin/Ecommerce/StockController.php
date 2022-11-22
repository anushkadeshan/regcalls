<?php

namespace App\Http\Controllers\Admin\Ecommerce;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StockCreateRequest;
use App\Http\Requests\Admin\StockUpdateRequest;
use App\Models\Apps\Ecommerce\Stock;
use Illuminate\Support\Facades\Auth;

class StockController extends Controller
{
    public function index(Request $request){
        $perpage = $request->input('perPage') ?: 10;
        $query = Stock::query();
        $query->when($request->input('search'), function($query, $search){
            $query->where('title','like', "%{$search}%");
            $query->orWhere('availability','like', "%{$search}%");
            $query->orWhere('type','like', "%{$search}%");
            $query->orWhere('status','like', "%{$search}%");
        });
        $query->when($request->input('field'), function($query, $field){
            $query->orderBy($field, request('direction'));
        });

        $stocks = $query->paginate($perpage)->withQueryString();
        return inertia('Apps/Ecommerce/Stocks/Stocks', [
            'stocks' => $stocks,
        ]);
    }

    public function store(StockCreateRequest $request){
        try{
            Stock::create($request->validated());
            return redirect()->back()->with([
                'message' => 'Stock Added Successfully',
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
        $stock = Stock::find($id);
        return inertia('Apps/Ecommerce/Stocks/Edit', [
            'stock' => $stock,
        ]);
    }

    public function update(StockUpdateRequest $request){

        try{
            Stock::where('id',$request->stock_id)->update($request->validated());
            return redirect()->back()->with([
                'message' => 'Stock Updated Successfully',
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
