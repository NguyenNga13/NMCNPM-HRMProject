<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpLaborContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emp_labor_contracts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('contract_number')->unique();
            $table->string('original_contract_number')->nullable();
            $table->boolean('classify'); //1: hợp đồng - 0: phụ lục
            $table->string('decided_number');
            $table->integer('id_emp')->unsigned();
            $table->foreign('id_emp')->references('id')->on('emp_profiles');
            $table->integer('id_contract_type')->unsigned();
            $table->foreign('id_contract_type')->references('id')->on('labor_contract_types');
            $table->float('duration')->nullable();
            $table->string('delegate');
            $table->date('date_signed');
            $table->date('date_begin');
            $table->date('date_finish')->nullable();
            $table->integer('salary_level')->nullable();
            $table->string('content');
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
        Schema::dropIfExists('emp_labor_contracts');
    }
}
