<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFournisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fournis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idFournisseur');
            $table->foreign('idFournisseur')
                  ->references('idFournisseur')
                  ->on('fournisseurs')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');
            $table->unsignedBigInteger('idMateriel');
            $table->foreign('idMateriel')
                  ->references('idMateriel')
                  ->on('materiels')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');
            $table->date('date');
            $table->integer('quantite');
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
        Schema::dropIfExists('fournis');
    }
}
