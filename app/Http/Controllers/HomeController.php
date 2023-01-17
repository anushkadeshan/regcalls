<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Apps\Ecommerce\Product;

class HomeController extends Controller
{
    function print_string($string)
    {
    $string = "Function w3docs \n";

    // Print $string variable
    print $string;
    }


    public function index(){
        $var2 = "sdsds";
        $var1 = &$var2;
        // Driver code
        $string = "Global w3docs \n";
        $this->print_string($string);
         $string;
        dd($string);
        $categories = Category::whereNotNull('image')->get();
        $products = Product::where('is_active',true)->where('status','Approved')->select('id','short_title','price','main_image','quantity')->latest()->get()->take(6);

        return Inertia::render('Welcome', [
            'categories' => $categories,
            'products' => $products
        ]);
    }

    public function products(Request $request){
        //dd($request);
        return Inertia::render('Client/Products/AllProducts', [
        ]);
    }

}
