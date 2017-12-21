<?php

use Illuminate\Database\Seeder;

class EmpPositionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('emp_positions')->insert([
        	['id_emp'=>'1', 'id_position'=>4,'id_department'=>1, 'date_begin'=>'2015-08-02', 'decided_number'=>'20150001','status'=>1, 'created_at'=>new DateTime()],
        	['id_emp'=>'2', 'id_position'=>7,'id_department'=>1, 'date_begin'=>'2015-08-02', 'decided_number'=>'20150002', 'status'=>1,'created_at'=>new DateTime()],
        	['id_emp'=>'3', 'id_position'=>7,'id_department'=>2, 'date_begin'=>'2015-08-02', 'decided_number'=>'20150003','status'=>1, 'created_at'=>new DateTime()],
            ['id_emp'=>'1', 'id_position'=>7,'id_department'=>1, 'date_begin'=>'2013-08-01', 'decided_number'=>'20130001', 'status'=>1, 'created_at'=>new DateTime()],
            ['id_emp'=>'1', 'id_position'=>7,'id_department'=>2, 'date_begin'=>'2013-08-02', 'decided_number'=>'20130002', 'status'=>0, 'created_at'=>new DateTime()],
        	]);

    }
}
