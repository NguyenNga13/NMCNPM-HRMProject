<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotifyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifies', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('type');
        $table->integer('from')->unsigned();
        $table->foreign('from')->references('id')->on('users');
        $table->integer('to')->unsigned()->nullable();
        // $table->foreign('to')->references('id')->on('users');
        $table->integer('id_update')->unsigned()->nullable();
        $table->foreign('id_update')->references('id')->on('emp_update_profiles');
        $table->integer('id_mail')->unsigned()->nullable();
        $table->string('notify')->nullable();
        $table->boolean('status')->default(0);
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
        //
        Schema::dropIfExists('notify');
    }
}
