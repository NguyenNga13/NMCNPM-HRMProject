<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInsurancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insurances', function (Blueprint $table) {
            $table->increments('id');
            $table->string('insurance');
            $table->float('rate_for_business');
            $table->float('rate_for_laborer');
            $table->date('applied_begin')->format('Y-m-d');
            $table->date('applied_finish')->format('Y-m-d');
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
        Schema::dropIfExists('emp_update_profiles');
    }
}
