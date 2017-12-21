<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emp_languages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_emp')->unsigned();
            $table->foreign('id_emp')->references('id')->on('emp_profiles');
            $table->string('language');
            $table->string('certificate_type');
            $table->string('level');
            $table->string('issued_by');
            $table->date('date_of_issued')->nullable();
            $table->date('expire')->nullable();
            $table->text('note')->nullable();
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
        Schema::dropIfExists('emp_languages');
    }
}
