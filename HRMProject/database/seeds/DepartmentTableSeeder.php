<?php

use Illuminate\Database\Seeder;

class DepartmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->insert([
        	['department'=>'Phòng kỹ thuật', 'description'=>'Quản lý, vận hành hệ thống', 'date_established'=>'2015-02-13', 'location'=>'Phòng 101', 'created_at'=>new DateTime()],
        	['department'=>'Phòng nhân sự', 'description'=>'Quản lý nhân sự', 'date_established'=>'2015-02-13', 'location'=>'Phòng 201', 'created_at'=>new DateTime()],
        	['department'=>'Phòng hành chính', 'description'=>'Quản lý', 'date_established'=>'2015-02-13', 'location'=>'Phòng 202', 'created_at'=>new DateTime()],
        	['department'=>'Phòng marketing', 'description'=>'', 'date_established'=>'2015-02-13', 'location'=>'Phòng 203', 'created_at'=>new DateTime()],
        	]);
    }
}
