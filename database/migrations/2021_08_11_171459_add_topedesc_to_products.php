<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTopedescToProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('products', function (Blueprint $table) {
            //
            //precio_del item al confirmar
            $table->decimal('topedesc',5,2)->nullable();
            $table->decimal('stkdisponible',8,2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
         Schema::table('products', function($table) {
        $table->dropColumn('topedesc');
        $table->dropColumn('stkdisponible');
        });
    }
}
