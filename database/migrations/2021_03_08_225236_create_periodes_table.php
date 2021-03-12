<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeriodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periodes', function (Blueprint $table) {
            $table->id();
            $table->date("dateDebut");
            $table->date("dateFin")->nullable();
            $table->unsignedBigInteger("idMedecin");
            $table->foreign("idMedecin")
            ->references("idMedecin")
            ->on("medecins")
            ->onDelete("restrict")
            ->onUpdate("restrict");
            $table->unsignedBigInteger("idStructure");
            $table->foreign("idStructure")
            ->references("idStructure")
            ->on("mstructures")
            ->onDelete("restrict")
            ->onUpdate("restrict");
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
        Schema::dropIfExists('periodes');
    }
}
