@extends('layouts.app')

@section('title','Bienvenido a Aristaeus Panel de Control')

@section('body-class','product-page')

@section('content')
<div class="header header-filter" style="background-image: url(' {{ asset('img/demofondo1.jpg') }}'); background-size: cover; background-position: top center;">
</div>

<div class="main main-raised">
    <div class="container">
        <div class="profile-tabs">
			<div class="nav-align-center">
                <ul class="nav nav-pills" role="tablist">
                    <li class="active">
                        <a href="#dashboard" role="tab" data-toggle="tab">
                            <i class="material-icons">camera</i>
                            Pedido Actual
                        </a>
                    </li>
                    <li>
                        <a href="#remitos" role="tab" data-toggle="tab">
                            <i class="material-icons">palette</i>
                            Pedidos Realizados
                        </a>
                    </li>
                    <!-- <li>
                        <a href="#shows" role="tab" data-toggle="tab">
                            <i class="material-icons">favorite</i>
                            Favorite
                        </a>
                    </li> -->
                </ul>

				<div class="tab-content gallery">
                    @if (session()->has('notification'))
                        <div class="alert alert-danger" role="alert">
                              <strong>Error:!!</strong>{{session('notification')}}
                        </div>
                    @endif
                    <div class="tab-pane active" id="dashboard">
                        <hr>
                         @if (auth()->user()->cart)
             
                        <p>Tu Pedido tiene {{ auth()->user()->cart->details->count() }} Items</p>
                        <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Nombre</th>
                                            <th >Precio</th>
                                            <th >Cantidad</th>
                                            <th >Sub total</th>
                                            <th >Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach( auth()->user()->cart->details as $detail)
                                        <tr>
                                            <td class="text-center">
                                                <img src="{{ url($detail->product->featured_image_url) }}" height="50">
                                            </td>
                                            <td>
                                                <a href=" {{ url('/products/'.$detail->product->id ) }}" > {{ $detail->product->name }}
                                            </td>
                                            <td >$ {{ $detail->product->price }}</td>
                                            <td> {{ $detail->quantity }}</td>
                                            <td> $ {{ $detail->quantity * $detail->product->price }}</td>
                                            <td class="td-actions">
                                                
                                                <form method="post" action="{{ url('/cart') }}">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE')}}
                                                    <input type="hidden" name="cart_detail_id" value="{{ $detail->id }}">
                                                    <a href=" {{ url('/products/'.$detail->product->id ) }}" target="_blank" type="button" rel="tooltip" title="Ver" class="btn btn-info btn-simple btn-xs">
                                                    <i class="fa fa-info"></i>
                                                    </a>
                                                    
                                                    <button type="submit" rel="tooltip" title="Eliminar" class="btn btn-danger btn-simple btn-xs">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                        </table>
                        <p> <strong> Importe a Pagar: {{ auth()->user()->cart->total }}</strong>  </p>

                        
                        @endif
                        <div class="text-center">
                            <form method="post" action="{{ url('/order')}}">
                                {{ csrf_field() }}
                                <!-- Sector para Ingresar el cliente en el pedido -->
                                <!-- <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group label-floating">
                                            <label class="form-group label-floating">Seleccionar  Cliente  </label>
                                            <select  class= "form-control" name="client_id" value="{{ old('client_id') }}">
                                                <option value="0">Sin Asignar Cliente</option>
                                                @foreach($clients as $client)
                                                {
                                                    <option value="{{$client->id}}">{{$client->name}}</option>   
                                                }
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>  -->
                                <button class="btn btn-primary btn-round">
                                    <i class="material-icons">done</i> Confirmar Pedido
                                </button>
                            </form>
                        </div>  
                    </div>
                    <div class="tab-pane text-center" id="remitos">
                        <!-- Lista de Remitos  -->
                        <hr>
                         @if (auth()->user()->cart)
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Fecha</th>
                                        <th class="text-center">Estado</th>
                                        <th class="text-center">Cliente</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($remitos as $key => $remito)
                                            @if ($remito->client_name != 'Sin Asignar')
                                            
                                                <tr>
                                                    <td> {{ $remito->id }} </td>
                                                    <td> {{ $remito->order_date }} </td>
                                                    <td> {{ $remito->status }} </td>
                                                    <td> {{ $remito->client_name }} </td>
                                                    <td class="td-actions">
                                                            
                                                            <form method="post" action="{{ url('/admin/remito/'.$remito->id).'/facturar' }}">
                                                                {{ csrf_field() }}
                                                                {{ method_field('DELETE')}}
                                                                <input type="hidden" name="cart_id" value="{{ $remito->id }}">
                                                                <a href=" {{  url('/admin/remito/'.$remito->id) }}"  type="button" rel="tooltip" title="Ver" class="btn btn-info btn-simple btn-xs">
                                                                <i class="fa fa-info"></i>
                                                                </a>
                                                                <a href=" {{  url('/admin/remito/'.$remito->id.'/edit') }}"  type="button" rel="tooltip" title="Editar" class="btn btn-info btn-simple btn-xs">
                                                                <i class="fa fa-edit"></i>
                                                                </a>
                                                                <button type="submit" rel="tooltip" title="Facturar" class="btn btn-danger btn-simple btn-xs">
                                                                    <i class="fa fa-point_of_sale"></i>
                                                                    <span class="material-icons">
                                                                    point_of_sale
                                                                    </span>
                                                                </button>
                                                            </form>
                                                        </td>
                                                    
                                                </tr>
                                            
                                            @endif
                                    
                                    @endforeach
                                
                                </tbody>
                            </table>
                         @endif

                    </div>
                    <!-- <div class="tab-pane text-center" id="shows">
                        <div class="row">
                            <div class="col-md-6">
                                <img src="../assets/img/examples/chris4.jpg" class="img-rounded" />
                                <img src="../assets/img/examples/chris6.jpg" class="img-rounded" />
                            </div>
                            <div class="col-md-6">
                                <img src="../assets/img/examples/chris7.jpg" class="img-rounded" />
                                <img src="../assets/img/examples/chris5.jpg" class="img-rounded" />
                                <img src="../assets/img/examples/chris9.jpg" class="img-rounded" />
                            </div>
                        </div>
                    </div> -->

				</div>


			</div>
		</div> 
    </div>

</div>

@include('includes.footer')
@endsection


