@extends('layouts.app')

@section('title','Todas nuestras Propuestas')

@section('body-class','product-page')

@section('content')
<div class="header header-filter" style="background-image: url(' {{ asset('img/demofondo1.jpg') }}');background-size: cover; background-position: top center;">
</div>
<div class="main main-raised">
    <div class="container">
        <form>
            <div class="form-group">
                <div class="col-sm-6">
                    <label >Cliente</label>
                    <input type="text" class="form-control" id="" name="client_name" value="{{$remito->client_name}}">
                </div>
                <div class="col-sm-6">
                    <label >Pedido N°</label>
                    <input type="text" class="form-control" id="" name="remito_id" value="{{ $remito->id }}">
                </div>
            </div>
            <!-- Detalle del Remito -->
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Código</th>
                        <th class="text-center">Nombre</th>
                        <th >Precio</th>
                        <th >Cantidad</th>
                        <th >Sub total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($remito->details as $detail)
                        <tr>
                            <td>
                                {{ $detail->id }}
                            </td>
                            <td>
                                {{ $detail->product->nro_art }}
                            </td>
                            <td>
                                {{ $detail->product->name }}
                            </td>
                            <td >$ {{ $detail->product->price }}</td>
                            <td> {{ $detail->quantity }}</td>
                            <td> $ {{ $detail->quantity * $detail->product->price }}</td>
                        
                        </tr
                    @endforeach>
                </tbody>
                <!-- Fin detalle del Remito -->
            </table>
            <p> <strong> Importe Total: {{$remito->total }}</strong>  </p>
            <a href=" {{ url('/admin/remito/'.$remito->id .'/remitopdf') }}" class="btn btn-default">Ver Pdf</a>
            @if ($remito->status =="Pending")
                <a href=" {{ url('/admin/remito/'.$remito->id .'/facturar') }}" class="btn btn-default">Facturar</a>            
            @endif
 
            <a href=" {{ url('/home') }}" class="btn btn-default">Volver</a>
        </form>
    </div>
</div>
@include('includes.footer')
@endsection
