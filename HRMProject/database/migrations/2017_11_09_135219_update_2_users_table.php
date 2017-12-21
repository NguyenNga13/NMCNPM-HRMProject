<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update2UsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function(Blueprint $table){
            $table->dropForeign('users_name_foreign');
            $table->dropColumn('name');
            $table->integer('id_emp')->unique()->unsigned()->nullable();
            $table->foreign('id_emp')->references('id')->on('emp_profiles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function(Blueprint $table){
            $table->dropForeign('users_id_emp_foreign');
            $table->dropColumn('id_emp');
            $table->integer('name')->unique()->unsigned();
            $table->foreign('name')->references('id')->on('emp_profiles');
        });
    }
}
