<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedecinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medecins', function (Blueprint $table) {
            $table->id('idMedecin');
            $table->string("reference",10)->unique();
            $table->string("nom");
            $table->string("prenom");
            $table->date("dateDeNaissance");
            $table->string("lieuDeNaissance");
            $table->string("sexe");
            $table->string("adresse");
            $table->string("telephone")->unique();
            $table->string("email")->unique();
            $table->string("description")->nullable();
            $table->unsignedBigInteger('idSpecialite');
            $table->foreign('idSpecialite')
                  ->references('idSpecialite')
                  ->on('specialites')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');
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
        Schema::dropIfExists('medecins');
    }
}
