<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdenesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordenes', function (Blueprint $table) {                    
            $table->string('pqrsfCodigo', '5');
            $table->string('ordId', '64'); // almacena bien sea el numero del ticket o el correo del funcionario que va a atender la orden (en caso de que no este en osticket)

            $table->string('ordTipo', '6'); // TICKET o CORREO
            $table->string('ordEstado', '1')->default('0'); // 0 Pendiente   1 Atendida
            $table->integer('idDependencia');
            $table->date('ordFecha');
            
            $table->foreign('pqrsfCodigo')->references('pqrsfCodigo')->on('pqrsfs');                        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ordenes');
    }
}
