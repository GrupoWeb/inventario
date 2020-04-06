<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Personas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->integer('id_persona')->primary()->unsigned();
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('cargo');
            $table->integer('id_dependencia');
            $table->string('nit');
            $table->integer('nivel');
            $table->integer('extension');
            $table->string('activo');
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
        Schema::dropIfExists('personas');
    }
}
