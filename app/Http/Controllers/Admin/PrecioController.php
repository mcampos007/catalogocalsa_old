<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Product;
use App\Precio;
use App\Category;
use App\Sector;
use App\User;

class PrecioController extends Controller
{
    //
    public function index(Request $request){
        $texto = trim($request->input('texto'));
        //dd($texto);
        $recargo = auth()->user()->recargo;
        $products = DB::table('products')
            ->select('id','name','price','nro_art','topedesc','con_descuento')
            ->where('name','LIKE','%'.$texto.'%')
            ->where('sector_id','=','1')
            ->orderBy('name','asc')
            ->paginate(5);
            //dd($products);
       return view('admin.precios.precios')->with(compact('products','texto','recargo'));
    }

    public function indexf(Request $request){
        $texto = trim($request->input('texto'));
        //dd($texto);
        $recargo = auth()->user()->recargo;
        $products = DB::table('products')
            ->select('id','name','price','nro_art','topedesc','con_descuento')
            ->where('name','LIKE','%'.$texto.'%')
            ->where('sector_id','=','2')
            ->orderBy('name','asc')
            ->paginate(5);

       return view('admin.precios.preciosf')->with(compact('products','texto','recargo'));
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

        if(isset($query)){
           $products = Product::where('name','like',"%$query%")->paginate(5);
        }
        else{

            $products = Product::paginate(5);
           
        }
       
        return view('search.productosfiltrados')->with(compact('products','query'));

    }
   
}
