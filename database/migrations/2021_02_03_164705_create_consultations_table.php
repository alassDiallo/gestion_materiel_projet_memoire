<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultations', function (Blueprint $table) {
            $table->id('idConsultation');
            $table->string('referenceConsultation')->unique();
            $table->date('date');
            $table->double('prixConsultation');
            $table->string('nomMedecin');
            $table->string('telephoneMedecin',12);
            $table->unsignedBigInteger('idPatient');
            $table->foreign('idPatient')
                  ->references('idPatient')
                  ->on('patients')
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
        Schema::dropIfExists('consultations');
    }
}
