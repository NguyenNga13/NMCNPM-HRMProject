<?php

use Illuminate\Database\Seeder;

class LaborContractTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('labor_contract_types')->insert([
        	['type'=>'Hợp đồng thử việc'],
        	['type'=>'Hợp đồng ngắn hạn'],
        	['type'=>'Hợp đồng dài hạn'],
        	['type'=>'Hợp đồng không thời hạn'],
        	]);
    }
}
