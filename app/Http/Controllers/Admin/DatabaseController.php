<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Admin\Database;
use App\Services\DatabaseService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use App\Http\Requests\Admin\DatabaseUpdateRequest;

class DatabaseController extends Controller
{

    public function index(Request $request){
        $perpage = $request->input('perPage') ?: 10;
        $query = Database::query();
        $query->when($request->input('search'), function($query, $search){
            $query->where('connection','like', "%{$search}%");
            $query->orWhere('host','like', "%{$search}%");
            $query->orWhere('port','like', "%{$search}%");
            $query->orWhere('database','like', "%{$search}%");
        });
        $query->when($request->input('field'), function($query, $field){
            $query->orderBy($field, request('direction'));
        });

        $databases = $query->paginate($perpage)->withQueryString();

        return inertia('Databases/Index', [
            'databases' => $databases,
        ]);
    }

    public function edit($id){
        $database = Database::findOrFail($id);
        return inertia('Databases/Edit', [
            'database' => $database,
        ]);
    }

    public function update(DatabaseUpdateRequest $request){
        try{
            Database::where('id',$request->id)->update($request->validated());
            return redirect()->back()->with([
                'message' => 'Database Updated Successfully',
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

    public function syncTables(){
        $databases = Database::select('database')->get();
        foreach($databases as $database){
            DatabaseService::CopyTablesFromTemplateDatabase($database->database);
        }
        return redirect()->back()->with([
            'message' => 'Database tables synced Successfully',
            'type' => 'success'
        ]);

    }
}
