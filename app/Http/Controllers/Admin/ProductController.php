<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products = Product::paginate(10);
        return view('admin.products.index')->with(compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
       // $categories = Category::all();
         $categories = Category::orderBy('name')->get();
       // dd($categories);
        return view('admin.products.create')->with(compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //VALIDAR
        $messages=[
            'name.required' => 'Es necesario ingresar un nombre para el producto',
            'name.min' => 'El nombre del producto debe terner al menos tres caracteres',
            'description.required' => 'Es necesario ingresar la descripción del Producto',
            'description.max' => 'La longitud de la descripción no puede tener mas de 200 car.',
            'price.required' => 'Es necesario ingresar el precio para el producto',
            'price.numeric' => 'El precio debe ser un numero ',
            'price.min' => 'el precio debe ser mayor que Cero',
            'category_id.required' => 'Se debe Selecionar una Categoria',
            'category_id.min' => 'Se debe Selecionar una Categoria'
        ];
        $rules= [
            'name' => 'required|min:3',
            'description' => 'required|max:200',
            'price' => 'required|numeric|min:0',
            'category_id'=>'required|min:1'
            
        ];
        $this->validate($request, $rules,$messages);
        //dd($request->all());
        $product = new Product();
        $product->name  = $request->input('name');
        $product->description  = $request->input('description');
        $product->price  = $request->input('price');
        $product->long_description  = $request->input('long_description');
        $product->category_id = $request->input('category_id');
        if ($product->categry_id === 0)
            $categories->category_id = NULL;
        $product->save();
        return redirect('/admin/products');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $product = Product::find($id);
        $categories = Category::all();

        return view('admin.products.edit')->with(compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         //VALIDAR
        $messages=[
            'name.required' => 'Es necesario ingresar un nombre para el producto',
            'name.min' => 'El nombre del producto debe terner al menos tres caracteres',
            'description.required' => 'Es necesario ingresar la descripción del Producto',
            'description.max' => 'La longitud de la descripción no puede tener mas de 200 car.',
            'price.required' => 'Es necesario ingresar el precio para el producto',
            'price.numeric' => 'El precio debe ser un numero ',
            'price.min' => 'el precio debe ser mayor que Cero'
        ];
        $rules= [
            'name' => 'required|min:3',
            'description' => 'required|max:200',
            'price' => 'required|numeric|min:0'
            
        ];
        $this->validate($request, $rules,$messages);
        //
        $product = Product::find($id);
        $product->name  = $request->input('name');
        $product->description  = $request->input('description');
        $product->price  = $request->input('price');
        $product->long_description  = $request->input('long_description');
        $product->category_id = $request->input('category_id');
        $product->save(); //UPDATE
        return redirect('/admin/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $product = Product::find($id);
 
        $product->delete();
        return back();
    }
}

