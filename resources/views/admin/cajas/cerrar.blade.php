@extends('layouts.app')

@section('title','Listado de Cajas')

@section('body-class','product-page')

@section('content')
<div class="header header-filter" style="background-image: url(' {{ asset('img/demofondo1.jpg') }}');background-size: cover; background-position: top center;">
</div>
<div class="wrapper">
    <div class="main main-raised">
        <div class="container">
            <div class="section text-center">
                {{-- <h2 class="title">Cierre de Caja N° {{$caja->id}}</h2> --}}
                {{-- <div class="team">
                    @if (session()->has('msj'))
                            <div class="alert alert-danger" role="alert">
                                  <strong>Error:!!</strong>{{session('msj')}}
                            </div>
                    @endif  
                </div>
                <div class="card-body">
                    @if (session('notification'))              
                    <div class="alert alert-success" role="alert">
                      {{ session('notification')}}
                    </div>
                    @endif
                </div> --}}
                @include('admin.cajas.includes.cabecera')
                @include('admin.cajas.includes.efectivo')
                @include('admin.cajas.includes.tarjetas')
                @include('admin.cajas.includes.otrafp')
                @include('admin.cajas.includes.gastos')
                @include('admin.cajas.includes.cheques')
                @include('admin.cajas.includes.resumen')
            @if(auth()->user()->role=="admin")
            <form method="post" action="{{ url('/admin/cajas/cerrar')}}">
            @else
            <form method="post" action="{{ url('/usuario/cajas/cerrar')}}">
            @endif
                                        {{ csrf_field() }}
                                        <input type="hidden" name="id" value="{{$caja->id}}">
                <button type="submit" rel="tooltip" title="Cerrar" class="btn btn-primary btn-round">
                    CERRAR
                </button>
                @if(auth()->user()->role=="admin")
                <a href="{{ url('/admin/cajas')}}" class="btn btn-primary btn-round">Volver</a>
                @else
                <a href="{{ url('/usuario/cajas')}}" class="btn btn-primary btn-round">Volver</a>
                @endif
            </form > 
            </div>        
        </div>

    </div>

</div>
@include('includes.footer')
@endsection

