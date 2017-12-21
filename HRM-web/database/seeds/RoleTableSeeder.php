<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
        	['role'=>'emp', 'description'=>'Nhân viên', 'created_at'=>new DateTime()],
        	['role'=>'hrm', 'description'=>'Quản lý hồ sơ nhân sự', 'created_at'=>new DateTime()],
        	['role'=>'accountant', 'description'=>'Quản lý tiền lương', 'created_at'=>new DateTime()],
        	]);
    }
}
