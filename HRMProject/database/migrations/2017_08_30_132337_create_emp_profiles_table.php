<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emp_profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('emp_code')->unique();
            $table->string('name');
            $table->integer('profile_number')->unique();
            $table->date('date_begin')->nullable();
            $table->string('photo_card');
            $table->boolean('gender');
            $table->date('date_of_birth')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->string('identity_card')->unique();
            $table->string('id_issued_by')->nullable();
            $table->date('id_date_of_issued')->nullable();
            $table->string('passport_number')->nullable();
            $table->string('passport_issued_by')->nullable();
            $table->date('passport_date_of_issued')->nullable();
            $table->date('passport_expiration_date')->nullable();
            $table->string('country')->nullable();
            $table->string('ethnic')->nullable();
            $table->string('religion')->default('Không');
            $table->string('household_address')->nullable();
            $table->string('address')->nullable();
            $table->string('telephone')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->boolean('marial_status')->nullable();
            $table->date('date_of_adherent')->nullable();
            $table->string('adherent_number')->nullable();
            $table->string('adherent_position')->nullable();
            $table->string('adherent_active_place')->nullable();
            $table->string('social_ins')->nullable();
            $table->string('health_ins')->nullable();
            $table->string('bank_account')->nullable();
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
        Schema::dropIfExists('emp_profiles');
    }
}
