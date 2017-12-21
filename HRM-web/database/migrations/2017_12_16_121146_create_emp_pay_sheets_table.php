<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpPaySheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emp_pay_sheets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_emp')->unsigned();
            $table->date('time');
            $table->integer('pay_value');
            $table->text('allowances')->nullable();
            $table->text('insurances')->nullable();
            $table->integer('income_tax')->nullable();
            $table->integer('prepay')->nullable();
            $table->integer('salary');
            $table->date('date_of_payment')->nullable();
            $table->text('note');
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
        Schema::dropIfExists('emp_pay_sheets');
    }
}
