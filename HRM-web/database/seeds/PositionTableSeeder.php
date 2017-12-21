<?php

use Illuminate\Database\Seeder;

class PositionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('positions')->insert([
            ['position'=>'Tổng Giám đốc', 'description'=>'Tổng Giám đốc', 'created_at'=>new DateTime()],
            ['position'=>'Giám đốc', 'description'=>'Giám đốc', 'created_at'=>new DateTime()],
            ['position'=>'Phó Giám đốc', 'description'=>'Phó Giám đốc', 'created_at'=>new DateTime()],
            ['position'=>'Trưởng phòng', 'description'=>'Trưởng phòng', 'created_at'=>new DateTime()],
            ['position'=>'Phó phòng', 'description'=>'Phó phòng', 'created_at'=>new DateTime()],
            ['position'=>'Leader', 'description'=>'Trưởng nhóm', 'created_at'=>new DateTime()],
            ['position'=>'Nhân viên', 'description'=>'Nhân viên', 'created_at'=>new DateTime()],

            ]);
    }
}
