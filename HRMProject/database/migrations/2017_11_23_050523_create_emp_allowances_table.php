<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpAllowancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emp_allowances', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_emp')->unsigned();
            $table->string('allowance_code');
            $table->string('allowance_level');
            $table->date('applied_begin');
            $table->date('applied_finish')->nullable();
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
        Schema::dropIfExists('emp_allowances');
    }
}
