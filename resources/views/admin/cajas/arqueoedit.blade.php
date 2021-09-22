@extends('layouts.app')

@section('title','Registro de Billetes')

@section('body-class','product-page')

@section('content')
<div class="header header-filter" style="background-image: url(' {{ asset('img/demofondo1.jpg') }}'); background-size: cover; background-position: top center;">
</div>

<div class="main main-raised">
    <div class="container">

        <div class="section ">
            <h2 class="title text-center">Editar Detalle de Billetes</h2>
            <h2 class="title text-center">Caja N° {{$caja->id}} Punto de Venta {{ $caja->puntodeventa->name }}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form method="post" action="{{ url('admin/cajas/arqueo') }}" enctype="multipart/form-data">
                {{csrf_field() }} 
              
            
            <div class="row">
                <div class="form-row">
                    <div class="form-group col-md-3">
                      <label for="billete1000">x 1000 </label>
                      <input type="text-right" name="billete1000" id="billete1000" 
                      value="{{ old('billete1000', $caja->efectivo->billete1000) }}" onchange="reCalcular()">
                    </div>                    
                    <div class="form-group col-md-3">
                      <label for="billete500">x 500 </label>
                      <input type="text-right" name="billete500" id="billete500" 
                      value="{{old('billete500', $caja->efectivo->billete500) }}" onchange="reCalcular()">
                    </div>
                    <div class="form-group col-md-3">
                      <label for="billete200">x 200 </label>
                      <input type="text-right" name="billete200" id="billete200" 
                      value="{{old('billete200', $caja->efectivo->billete200) }}" onchange="reCalcular()">
                    </div>                    
                    <div class="form-group col-md-3">
                      <label for="billete100">x 100 </label>
                      <input type="text-right" name="billete100" id="billete100" 
                      value="{{old('billete100', $caja->efectivo->billete100) }}" onchange="reCalcular()">
                    </div>
                    <div class="form-group col-md-3">
                      <label for="billete50">x 50 </label>
                      <input type="text-right" name="billete50" id="billete50" 
                      value="{{old('billete50', $caja->efectivo->billete50) }}" onchange="reCalcular()">
                    </div>
                    <div class="form-group col-md-3">
                      <label for="billete20">x 20 </label>
                      <input type="text-right" name="billete20" id="billete20" 
                      value="{{old('billete20', $caja->efectivo->billete20) }}" onchange="reCalcular()">
                    </div>
                    <div class="form-group col-md-3">
                      <label for="billete10">x 10 </label>
                      <input type="text-right" name="billete10" id="billete10" 
                      value="{{old('billete10', $caja->efectivo->billete10) }}" onchange="reCalcular()">
                    </div>
                </div>
            </div>
            <div class="form-row" id="totales"> 
                <div class="input-group">
                    <label for="totalbilletes">TOTAL $</label>
                    <input type="text" name="total" id="totalbilletes" disabled value="">
                </div> 
            </div> 
            <div class="form-row">
                <div class="row">
                    <input type="hidden" name="caja_id" value="{{ $caja->id}}">
                </div>
                <div class="form-group col-md-6">
                    <button type="submit" class="btn btn-primary">Registrar Arqueo</button>
                     <a href=" {{ url('/admin/cajas')}}" class="btn btn-default">Cancelar</a>
                </div>
            </div>
             
            </form>
        </div>

    </div>

</div>

@include('includes.footer')
@endsection

<script>
    
window.onload=function (){
 
    reCalcular();
 }


    function reCalcular(){
        var total = 0;
        var total1000  = 1000 *  document.getElementById("billete1000").value;
        total  = total + total1000;
        var total500 = 500 * document.getElementById("billete500").value;
        total = total + total500;
        var total200 = 200 * document.getElementById("billete200").value;
        total = total + total200;
        var total100 = 100 * document.getElementById("billete100").value; 
        total = total + total100;
        var total50  = 50 * document.getElementById("billete50").value;
        total = total + total50;
        var total20  = 20 * document.getElementById("billete20").value;
        total = total + total20;
        var total10 = 10 *  document.getElementById("billete10").value;
        total = total + total10;
        

        var _html = '<label for="totalbilletes">TOTAL $</label>';
        _html = _html + '<input type="text" name="total" id="totalbilletes" disabled value="';
        _html = _html + total;
        _html = _html + '">';
        document.getElementById("totales").innerHTML = _html;
    }
    
</script>
