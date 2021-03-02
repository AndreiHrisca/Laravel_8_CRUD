<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * Tabla clientes.
         */
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
           
            $table->string('Nombre');
            $table->string('Apellido');
            $table->string('Dni');
            $table->string('Correo');
            $table->string('Foto'); 
            
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
        Schema::dropIfExists('clientes');
    }
}
