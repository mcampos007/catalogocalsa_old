@extends('layouts.app')

@section('title','Bienvenido a DigTab by Infocam')

@section('body-class','product-page')

@section('content')
<div class="header header-filter" style="background-image: url(' {{ asset('img/demofondo1.jpg') }}'); background-size: cover; background-position: top center;">
</div>

<div class="main main-raised">
    <div class="container">

        <div class="section ">
            <h2 class="title text-center">Editar Pago</h2>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="post" action="{{ url('admin/cajas/otrafp/edit') }}" enctype="multipart/form-data">
                {{csrf_field() }} 
                <input type="hidden" name="id" value="{{$otropago->id}}">
                <div class="form-row">
                    <div class="col-md-6">
                        <label for="fecha">Fecha</label>
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                            </div>
                            <input class="form-control datepicker" placeholder="Seleccionar Fecha de Emisión" 
                            name ="fecha"
                            id = "date" type="text" value="{{ old('fecha',$otropago->fecha)}}" 
                            data-date-format="yyyy-mm-dd" 
                            data-date-start-date="{{ date('Y-m-d')}}"  
                            data-date-end-date="+30d"
                            required>                   
                    </div>
                    <div class="col-md-6">
                        <label for="cliente">Cliente</label>
                          <select class="form-control" name="client_id" id="cliente" required>
                                <option value="{{$otropago->client_id}}" selected>{{$otropago->client->name}}</option>
                                @foreach($clients as $client)
                                    <option value ="{{$client->id}}" @if(old('client_id')== $client->id) selected @endif>
                                        {{$client->name}}
                                    </option>
                                @endforeach
                            </select>                           
                    </div>   
                </div>
                <div class="form-row">
                       
                </div> 
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="cliente">Tipo de Ingreso</label>
                          <select class="form-control" name="tipomovimiento_id" id="tipomovimiento" required>
                            <option value="{{$otropago->tipomovimiento_id}}" selected="">{{$otropago->tipomovimiento->name}}</option>
                            @foreach($tipomovimientos as $tipomovimiento)
                                <option value ="{{$tipomovimiento->id}}" @if(old('tipomovimiento_id')== $tipomovimiento->id) selected @endif>
                                    {{$tipomovimiento->name}}
                                </option>
                            @endforeach
                        </select>   
                    </div>
                    <div class="form-group col-md-4">
                      <label for="detalle">Detalle</label>
                      <input type="text" class="form-control" 
                      value="{{old('detalle', $otropago->detalle)}}"
                      name="detalle" required>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="importe">Importe</label>
                      <input type="importe" class="form-control" 
                      value="{{old('importe',$otropago->importe)}}" 
                      name="importe" required>
                    </div>
                </div> 
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <button type="submit" class="btn btn-primary">Actualizar Ingreso</button>
                         <a href=" {{ url('/admin/cajas')}}" class="btn btn-default">Cancelar</a>
                    </div>
                </div>
            </form>

        </div>

    </div>

</div>

@include('includes.footer')
@endsection
