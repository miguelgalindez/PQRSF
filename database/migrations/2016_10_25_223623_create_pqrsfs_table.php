<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePqrsfsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pqrsfs', function (Blueprint $table) {
            $table->string('pqrsfCodigo', '5')->unique();
            $table->string('perId', '16');
            $table->string('perTipoId', '32');
            $table->string('radId', '16')->nullable();
            $table->string('pqrsfTipo', '1');
            $table->string('pqrsfAsunto', '128');
            $table->string('pqrsfDescripcion', '1024');
            $table->date('pqrsfFechaCreacion');
            $table->string('pqrsfMedioRecepcion', '32');
            $table->tinyInteger('pqrsfEstado');
            $table->date('pqrsfFechaVencimiento')->nullable();
            $table->date('pqrsfFechaCierre')->nullable();   

            $table->primary('pqrsfCodigo');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pqrsfs');
    }
}
