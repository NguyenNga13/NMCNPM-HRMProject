<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpSpecializedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emp_specializeds', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_emp')->unsigned();
            $table->foreign('id_emp')->references('id')->on('emp_profiles');
            $table->string('specialized');
            $table->string('degree'); //Tiến Sĩ/Thạc sĩ/Kỹ sư/Cử nhân/Cao đẳng/Cao đẳng/Trung cấp
            $table->string('training_type')->nullable(); //Chính quy / Tại chức
            $table->string('level');
            $table->string('issued_by');
            $table->date('date_of_issued');
            $table->date('begin')->nullable();
            $table->date('finish')->nullable();
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
        Schema::dropIfExists('emp_specializeds');
    }
}
