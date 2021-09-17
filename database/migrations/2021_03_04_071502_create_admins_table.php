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
            $table->string('name', property('rules.admin.name.max'));
            $table->string('pat_surname', property('rules.admin.pat_surname.max'));
            $table->string('mat_surname', property('rules.admin.mat_surname.max'));
            $table->string('matricula', property('rules.admin.matricula.max'))->unique();
            $table->string('telephone',  property('rules.admin.telephone.max'));

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
