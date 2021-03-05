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
            $table->string('nombre',100);
            $table->string('ap_paterno',100);
            $table->string('ap_materno',100);
            $table->string('matricula',15)->unique();
            $table->string('email')->unique();
            $table->string('telefono', 15);
            $table->string('password');

            $table->foreignId('carrera_id')->constrained('carreras_catalog');

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
