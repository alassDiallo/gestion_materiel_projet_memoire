<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factures', function (Blueprint $table) {
            $table->id("idFacture");
            $table->string("reference",10)->unique();
            $table->double("montant");
            $table->double("priseEC");
            $table->double("prixP");
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
        Schema::dropIfExists('factures');
    }
}
