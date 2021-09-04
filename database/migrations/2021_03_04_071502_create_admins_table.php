<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', property('rules.admin.nombre.max'));
            $table->string('ap_paterno', property('rules.admin.ap_paterno.max'));
            $table->string('ap_materno', property('rules.admin.ap_materno.max'));
            $table->string('matricula', property('rules.admin.matricula.max'))->unique();
            $table->string('telefono',  property('rules.admin.telefono.max'));

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
        Schema::dropIfExists('admin');
    }
}
