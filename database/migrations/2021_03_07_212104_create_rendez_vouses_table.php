<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRendezVousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rendez_vouses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idMedecin');
            $table->foreign('idMedecin')
                ->references('idMedecin')
                ->on('medecins')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->unsignedBigInteger('idPatient');
            $table->foreign('idPatient')
                ->references('idPatient')
                ->on('patient')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->string("etat");
            $table->dateTime("dateEtHeure");
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
        Schema::dropIfExists('rendez_vous');
    }
}
