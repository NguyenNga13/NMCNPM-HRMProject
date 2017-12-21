<?php

use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
        	['permission'=>'Create', 'note'=>'Tạo', 'created_at'=>new DateTime()],
        	['permission'=>'Edit', 'note'=>'Sửa', 'created_at'=>new DateTime()],
            ['permission'=>'Delete', 'note'=>'Xóa', 'created_at'=>new DateTime()],
            ['permission'=>'View', 'note'=>'Xem', 'created_at'=>new DateTime()],
            ]);
    }
}
