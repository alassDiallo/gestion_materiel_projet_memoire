<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVolontairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('volontaires', function (Blueprint $table) {
            $table->id('idVolontaire');
            $table->string('referenceVolontaire',10)->unique();
            $table->String('nom');
            $table->String('prenom');
            $table->date('dateDeNaissance');
            $table->string('lieuDeNaissance');
            $table->string('adresse');
            $table->string('telephone',9)->unique();
            $table->string('email')->unique();
            $table->string('numeroCIN',12)->unique();
            $table->boolean('etat');
            // $table->unsignedBigInteger('idStructure');
            // $table->foreign('idStructure')
            //       ->references('idStructure')
            //       ->on('structures')
            //       ->onDelete('restrict')
            //       ->onUpdate('restrict');
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
        Schema::dropIfExists('volontaires');
    }
}
