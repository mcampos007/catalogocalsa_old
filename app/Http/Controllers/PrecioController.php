<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Precio;
use App\Category;

class PrecioController extends Controller
{
    //
    public function index(){
        $products = Product::paginate(10);
        return view('precios')->with(compact('products'));
    }

    public function data()
    {
        $products = Product::pluck('name');
        return $products;
    }

    public function show(Request $request)
    {
        //

        $query = $request->input('query');

        $products = Product::where('name','like',"%$query%")->paginate(5);

        if ($products->count() == 1){
            $id = $products->first()->id;
            return redirect("products/$id");
        }


        return view('search.showprices')->with(compact('products','query'));

    }
   
}
