<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEffectuersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('effectuers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idPatient');
            $table->foreign('idPatient')
                   ->references('idPatient')
                   ->on('patients')
                   ->onDelete('restrict')
                   ->onUpdate('restrict'); 
                   $table->unsignedBigInteger('idAnalyse');
                   $table->foreign('idAnalyse')
                          ->references('idAnalyse')
                          ->on('analyses')
                          ->onDelete('restrict')
                          ->onUpdate('restrict');
            $table->date('date'); 
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
        Schema::dropIfExists('effectuers');
    }
}
