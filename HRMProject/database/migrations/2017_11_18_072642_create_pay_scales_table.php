<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayScalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pay_scales', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pay_scale_code');
            $table->string('pay_scale');
            $table->text('range');
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
        Schema::dropIfExists('pay_scales');
    }
}
