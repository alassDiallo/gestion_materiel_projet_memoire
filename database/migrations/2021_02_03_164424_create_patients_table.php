<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id('idPatient');
            $table->string('referencePatient',12)->unique();
            $table->string('nom');
            $table->string('prenom');
            $table->date('dateDeNaissance');
            $table->string('lieuDeNaissance');
            $table->string('sexe');
            $table->string('adresse');
            $table->string('telephone',9)->unique();
            $table->string('numeroCIN',12)->unique();
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
        Schema::dropIfExists('patients');
    }
}
