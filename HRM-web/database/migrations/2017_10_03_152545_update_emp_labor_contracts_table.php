<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateEmpLaborContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {    
        Schema::table('emp_labor_contracts', function(Blueprint $table){
            $table->foreign('original_contract_number')->references('contract_number')->on('emp_labor_contracts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('emp_labor_contracts', function(Blueprint $table){
            $table->dropForeign('emp_labor_contracts_original_contract_number_foreign');
        });
    }
}
