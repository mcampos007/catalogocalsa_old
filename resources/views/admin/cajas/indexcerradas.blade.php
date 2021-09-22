@extends('layouts.app')

@section('title','Listado de Cajas Cerrada')

@section('body-class','product-page')

@section('content')
<div class="header header-filter" style="background-image: url(' {{ asset('img/demofondo1.jpg') }}');background-size: cover; background-position: top center;">
</div>

<div class="main main-raised">
    <div class="container">
        <div class="section text-center">
            <h2 class="title">Listado de Cajas Cerradas</h2>
            <div class="card-body">
                @if (session('notification'))
                
                <div class="alert alert-success" role="alert">
                  {{ session('notification')}}
                </div>
                @endif

              </div>

            <div class="team">
                @if (session()->has('msj'))
                        <div class="alert alert-danger" role="alert">
                              <strong>Error:!!</strong>{{session('msj')}}
                        </div>
                    @endif
                <div class="row ">
                    
                    <a href="{{ url('/admin/cajas/create')}}" class="btn btn-primary btn-round">Nueva Caja</a>
                    <table class="table-responsive table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="col-md-2 text-center">Fecha</th>
                                <th class="col-md-2 text-left">Punto de Vta.</th>
                                <th class="col-md-2 text-left">Usuario</th>
                                <th class="col-md-2 text-left">Total</th>
                                <th class="col-md-2 text-left">Estado</th>
                                {{-- <th>Imágen</th>
                                 <th class="text-center">Categoria</th>
                                <th >Precio</th> --}}
                                <th class="col-md-2">Opciones</th> 
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cajas as $caja)
                            <tr>
                                <td class="text-center">{{ $caja->id }}</td>
                                <td class="text-center">{{ $caja->fecha }}</td>
                                <td class="text-left">{{ $caja->puntodeventa->name }}</td>
                                <td class="col-md-2 text-left>" >{{ $caja->user->name }}</td>
                                <td>{{ $caja->totalplanilla}}</td>
                                <td>{{ $caja->status}}</td>
                                <td class="td-actions text-right">        
                                    <form method="post" action="{{ url('/admin/cajas/'.$caja->id)}}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE')}}
                                        @if($caja->status == 'Cerrada')
                                            <a href="{{ url('/admin/cajas/'.$caja->id.'/arqueo')}}" type="button" rel="tooltip" title="Arqueo" class="btn btn-info btn-simple btn-xs ">
                                            <i class="bi bi-cash-coin"></i>
                                            </a>
                                            <a href="{{ url('/admin/cajas/'.$caja->id.'/egreso')}}" type="button" rel="tooltip" title="Egresos" class="btn btn-info btn-simple btn-xs">
                                            <i class="bi bi-currency-dollar"></i>
                                            </a>
                                            <a href="{{ url('/admin/cajas/'.$caja->id.'/cheque')}}" type="button" rel="tooltip" title="Cheques" class="btn btn-info btn-simple btn-xs">
                                            <i class="bi bi-currency-exchange"></i>
                                            </a>
                                            <a href="{{ url('/admin/cajas/'.$caja->id.'/tarjeta')}}" type="button" rel="tooltip" title="Tarjetas" class="btn btn-info btn-simple btn-xs">
                                            <i class="fa fa-info"></i>
                                            </a>
                                            <a href="{{ url('/admin/cajas/'.$caja->id.'/otrafp')}}" type="button" rel="tooltip" title="Otros MP" class="btn btn-info btn-simple btn-xs">
                                            <i class="fa fa-calendar-check-o"></i>
                                            </a>
                                            <a href=" {{ url('/admin/cajas/'.$caja->id.'/cerrar')}}" type="button" rel="tooltip" title="Cerrar" class="btn btn-success btn-simple btn-xs">
                                            <i class="fa fa-edit"></i>
                                            </a>
                                            <button type="submit" rel="tooltip" title="Eliminar" class="btn btn-danger btn-simple btn-xs">
                                            <i class="fa fa-times"></i>
                                        </button>
                                        @endif    
                                        
                                    </form>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $cajas->links() }}
                </div>
            </div>

        </div>
    </div>
</div>

@include('includes.footer')
@endsection
