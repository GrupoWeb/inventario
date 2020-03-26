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
            $table->bigInteger('id_producto')->unsigned();
            $table->string('comentario');
            $table->float('valor_costo',8,2);
            $table->date('fecha_ingreso');
            $table->string('codigo_sicoin');
            $table->integer('id_lugar_fisico');
            $table->bigInteger('id_empleado')->unsigned();
            $table->bigInteger('id_categoria')->unsigned();
            $table->bigInteger('id_estado_producto')->unsigned();
            $table->bigInteger('id_dependencia')->unsigned();
            $table->bigInteger('id_cuenta')->unsigned();
            $table->string('no_factura');
            $table->bigInteger('id_proveedor')->unsigned();
            $table->float('alza',8,2);
            $table->float('baja',8,2);
            $table->timestamps();

            $table->foreign('id_producto')->references('id_producto')->on('productos');
            $table->foreign('id_estado_producto')->references('id_estadoP')->on('estado_productos');
            $table->foreign('id_empleado')->references('id_persona')->on('personas');
            $table->foreign('id_dependencia')->references('id_dependencia')->on('dependencias');
            $table->foreign('id_cuenta')->references('id_cuenta')->on('cuenta_activos');
            $table->foreign('id_proveedor')->references('id_proveedor')->on('proveedores');
            $table->foreign('id_categoria')->references('id_categoria')->on('categoria_activos');
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
