<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use App\Mail\NewOrder;
use Mail;
use App\Cart;
use App\Product;
use App\CartDetail;
use App\client;
use App\Sucursal;
//use App\CartDetail;
class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //public function update(Request $request, $id)
    public function update(Request $request)
    {
        //
         $client = auth()->user() ;
         $cart = $client->cart;
         $cart->status = 'Pending';
         $cart->client_id = $request->input('client_id');
         $cart->order_date = Carbon::now();
         $cart->sucursal_id = $request->input('sucursal_id');
         foreach ($cart->details as $item){
           //  echo $item->id."----". $item->product_id;
             $product = Product::find($item->product_id);
             $detalle = CartDetail::find($item->id);
            // echo "....".$product->price;
            // echo "</br>";
             $detalle->price = $product->price;
             $detalle->save(); 
         }

         $cart->save();

         //Poner precio en los articulos del remito
        
        //$admins = "mcampos.infocam@gmail.com";        
        //$admins = User::where('admin',true)->get()->pluck('email');
        // mail::to($admins)->send(new NewOrder($client, $cart));
         
         $notification = "Tu Pedido ya fué confirmado y en Breve nos pondremos en contacto";
         $typenotif = 'Sucees';

         $clients = Client::All();
         $remitos = Cart::All();

         $sucursales = Sucursal::all();
      
        //$comments = Post::find(1)->comments()->where('title', '=', 'foo')->first();
        //return view('home')->with(compact('clients','remitos'));
        return redirect('/home')->with(compact('clients','remitos','sucursales','notification','typenotif'));   
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
    }

    
}
