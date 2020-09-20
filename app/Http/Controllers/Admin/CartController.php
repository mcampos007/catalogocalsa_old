<?php

namespace App\Http\Controllers\Admin;
use App\Exports\RemitoExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade as PDF; 
use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Cart;
use App\Invoice;
use App\InvoiceDetail;

class CartController extends Controller
{
    //
    public function vercart($id)
    {
        $remito = Cart::find($id);
        return view('admin.remitos.index')->with(compact('remito'));
        
    }

    //FActurar Remito
    public function facturarremito($id)
    {
        $remito = Cart::find($id);
        //dd($remito);
        return view('admin.remitos.facturar')->with(compact('remito'));
        
    }

    public function excel($id)
    {
        return Excel::download(new RemitoExport, 'remito.xlsx', $id);
    }

    public function edit($id)
    {
        $remito = Cart::find($id);
        return view('admin.remitos.index')->with(compact('remito'));
    }

    public function remitopdf($id)
    {
        $today = Carbon::now()->format('d/m/Y');
        $remito = Cart::find($id);
        $detalle = $remito->details;
      //  dd($remito->client_Name);
       //dd($remito->details);
        $pdf = PDF::loadView('admin.remitos.remito',compact('remito','detalle'));
        //return $pdf->download();
        return $pdf->stream();
    }

    //Pasaje de Remito a FActura
    public function update(Request $request)
    {
        //
        $remito_id = $request->input('remito_id');

        
        // Traer el Remito y pasar a Factura.
        $cart = Cart::find($remito_id);
        $invoice = new Invoice();
        
        $invoice->client_id = $cart->client_id;
        $invoice->status = 'Pending';
        $invoice->invoice_date = Carbon::now();
        $invoice->user_id = auth()->user()->id ;
        $invoice->cart_id = $cart->id;
        $invoice->total = $cart->total;
        $invoice->acuenta = 0;
        $invoice->save();

        // Traer los detalles del remito y pasar a Detalle de Factura
        
        
        foreach ($cart->details as $detail)
        {
            $detainvoice = new InvoiceDetail();
            $detainvoice->invoice_id = $invoice->id;
            $detainvoice->product_id = $detail->product_id;
            $detainvoice->quantity = $detail->quantity;
            $detainvoice->price = $detail->price;
            $detainvoice->save();
        }
        
        //Canbiar el estado del Remito  a Invoiced
        $cart->status ="Invoiced";
        $cart->save();
         
         //$admins = User::where('admin',true)->get()->pluck('email');
         //mail::to($admins)->send(new NewOrder($client, $cart));
         
         $notification = "Tu Remito ya fué Facturado";

          $remito = Cart::find($remito_id);
        return view('admin.remitos.index')->with(compact('remito'));
    }
}
