<?php

use Illuminate\Database\Seeder;

class AccessTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('access')->insert([
    		['function'=>'user', 'subject'=>'Nhân viên'],
    		['function'=>'admin', 'subject'=>'Quản trị viên hệ thống'],
    		['function'=>'hrm', 'subject'=>'Nhân viên quản lý nhân sự'],
    		['function'=>'accountant', 'subject'=>'Nhân viên kế toán'],
    		]);
    }
}

