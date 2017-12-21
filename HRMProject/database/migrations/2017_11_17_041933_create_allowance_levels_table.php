<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllowanceLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('allowance_levels', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_allowance')->unsigned();
            $table->foreign('id_allowance')->references('id')->on('allowances');
            $table->string('level');
            $table->float('rate')->nullable();
            $table->float('value')->nullable();
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
        Schema::dropIfExists('allowance_levels');
    }
}
