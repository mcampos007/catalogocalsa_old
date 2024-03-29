<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGastosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gastos', function (Blueprint $table) {
            $table->increments('id');
            
            $table->string('detalle');
            $table->decimal('importe', 8, 2);
            $table->date('fecha');
             //Clave Foránea a la Tabla de Cajas
            $table->Integer('cajas_id')->unsigned()->nullable();
            $table->foreign('cajas_id')->references('id')->on('cajas');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gastos');
    }
}
