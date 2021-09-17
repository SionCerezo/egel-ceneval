<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColaboradoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colaboradores', function (Blueprint $table) {
            $table->id();
            $table->string('name', property('rules.alumno.name.max'));
            $table->string('pat_surname', property('rules.alumno.pat_surname.max'));
            $table->string('mat_surname', property('rules.alumno.mat_surname.max'));
            $table->string('matricula', property('rules.alumno.matricula.max'))->unique();
            $table->string('telephone',  property('rules.alumno.telephone.max'));

            $table->string('carrera_id')->references('id')->on('carreras_catalog');

            // $table->timestamp('email_verified_at')->nullable();
            // $table->rememberToken();
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('collaborator');
    }
}
