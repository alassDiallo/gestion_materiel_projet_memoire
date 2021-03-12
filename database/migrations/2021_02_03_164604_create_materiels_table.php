<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterielsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materiels', function (Blueprint $table) {
            $table->id('idMateriel');
            $table->string('reference')->unique();
            $table->unsignedBigInteger('idVolontaire')->nullable();
            $table->foreign('idVolontaire')
                  ->references('idVolontaire')
                  ->on('volontaires')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');
            $table->string('libelle');
            $table->string('type');
            $table->double('prix');
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
        Schema::dropIfExists('materiels');
    }
}
