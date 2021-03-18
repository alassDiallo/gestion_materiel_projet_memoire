<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->id();
            $table->integer('quantite');
            $table->string('indication');
            $table->unsignedBigInteger('idMedicament');
            $table->foreign('idMedicament')
                  ->references('idMedicament')
                  ->on('medicaments')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');
             $table->string('idOrdonnance');
             $table->foreign('idOrdonnance')
                  ->references('idOrdonnance')
                  ->on('ordonnances')
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
        Schema::dropIfExists('prescriptions');
    }
}
