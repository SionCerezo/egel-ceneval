<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumnos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', property('rules.alumno.nombre.max'));
            $table->string('ap_paterno', property('rules.alumno.ap_paterno.max'));
            $table->string('ap_materno', property('rules.alumno.ap_materno.max'));
            $table->string('matricula', property('rules.alumno.matricula.max'))->unique();
            $table->string('email')->unique();
            $table->string('telefono',  property('rules.alumno.telefono.max'));
            $table->string('password');
            // borrar esta columna
            $table->string('pass_decifrada');

            $table->string('carrera_id')->references('id')->on('carreras_catalog');

            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
