<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConvocatoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('convocatorias', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->mediumText('descripcion')->nullable();
            $table->morphs('create_user');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');

            $table->foreignId('periodo_id')->constrained();
            $table->foreignId('status_id')->constrained('status_catalog');

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
        Schema::dropIfExists('convocatoria');
    }
}
