<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->string('perId', '16')->unique();
            $table->string('perTipoId', '32');
            $table->string('perTipo', '32');
            $table->string('perNombres', '64');
            $table->string('perApellidos', '64');
            $table->string('perEmail', '32');
            $table->string('perDireccion', '64');
            $table->string('perTelefono', '32')->nullable();
            $table->string('perCelular', '16');            
            $table->timestamps();

            $table->primary('perId');
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
