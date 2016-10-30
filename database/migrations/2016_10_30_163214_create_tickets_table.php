<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {            
            $table->string('ticketId')->unique();
            $table->string('pqrsfCodigo', '5');

            $table->primary('ticketId');
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
        Schema::dropIfExists('tickets');
    }
}
