<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDurersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('durers', function (Blueprint $table) {
            $table->id();
            $table->date("dateDebut");
            $table->date("dateFin");
            $table->unsignedBigInteger("idVolontaire");
            $table->foreign("idVolontaire")
                ->references("idVolontaire")
                ->on("volontaires")
                ->onDelete("restrict")
                ->onUpdate("restrict");
            $table->unsignedBigInteger("idStructure");
            $table->foreign("idStructure")
                ->references("idStructure")
                ->on("structures")
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
        Schema::dropIfExists('durer');
    }
}
