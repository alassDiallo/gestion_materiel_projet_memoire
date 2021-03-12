<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consulters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idPatient');
            $table->foreign('idPatient')
                  ->references('idPatient')
                  ->on('patients')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');
            $table->unsignedBigInteger('idMedecin');
            $table->foreign('idMedecin')
                  ->references('idMedecin')
                  ->on('medecin')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');
            $table->date("date");
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
        Schema::dropIfExists('consulters');
    }
}
