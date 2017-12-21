<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpWorkDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emp_work_days', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_emp')->unsigned();
            $table->date('time');
            $table->integer('man_day');
            $table->integer('paid_leave_day')->nullable();
            $table->integer('holiday_leave_day')->nullable();
            $table->integer('sick_leave_day')->nullable();
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
        Schema::dropIfExists('emp_work_days');
    }
}
