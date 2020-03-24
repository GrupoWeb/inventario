<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Activos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activos', function (Blueprint $table) {
            $table->bigIncrements('id_activo');
            $table->integer('no_folio');
            $table->integer('no_libro');
            $table->string('documento_ingreso');
            $table->string('numero_movimiento');
            $table->string('inventario_fisico');
            $table->integer('renglon');
            $table->integer('cantidad_producto');
            $table->string('fecha_fiscal');
            $table->string('registro_factura');
            $table->integer('id_producto');
            $table->string('comentario');
            $table->float('valor_costo',8,2);
            $table->date('fecha_ingreso');
            $table->string('codigo_sicoin');
            $table->integer('id_lugar_fisico');
            $table->integer('id_empleado');
            $table->integer('id_categoria');
            $table->integer('id_estado_producto');
            $table->integer('id_dependencia');
            $table->integer('id_cuenta');
            $table->string('no_factura');
            $table->integer('id_proveedor');
            $table->float('alza',8,2);
            $table->float('baja',8,2);
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
        Schema::dropIfExists('activos');
    }
}
