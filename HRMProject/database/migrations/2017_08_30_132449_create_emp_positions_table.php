<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpPositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emp_positions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_emp')->unsigned();
            $table->foreign('id_emp')->references('id')->on('emp_profiles');
            $table->integer('id_position')->unsigned();
            $table->foreign('id_position')->references('id')->on('positions');
            $table->integer('id_department')->unsigned();
            $table->foreign('id_department')->references('id')->on('departments');
            $table->date('date_begin');
            $table->date('date_finish')->nullable();
            $table->string('decided_number')->nullable();
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('emp_positions');
    }
}
