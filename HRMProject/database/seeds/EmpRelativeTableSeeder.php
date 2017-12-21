<?php

use Illuminate\Database\Seeder;

class EmpRelativeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('emp_relatives')->insert([
        	['id_emp'=>'1', 'name'=>'Lê Thu Thảo', 'relationship'=>'Mẹ', 'date_of_birth'=>'1971-02-06', 'career'=>'Bác sĩ', 'address'=>'23 ngách 1189/23 Giải Phóng > Hoàng Mai > Hà Nội', 'phone'=>'0965125378'],
        	['id_emp'=>'2', 'name'=>'Hoàng Lan Thu', 'relationship'=>'Vợ', 'date_of_birth'=>'1994-02-12', 'career'=>'Kế toán', 'address'=>'19B ngách 1197/23 Thịnh Liệt > Hoàng Mai > Hà Nội', 'phone'=>'01634589456'],
        	['id_emp'=>'3', 'name'=>'Nguyễn Lâm Hải', 'relationship'=>'Bố', 'date_of_birth'=>'1962-09-12', 'career'=>'Nông dân', 'address'=>'23 Nguyễn Trãi > Hồng Bàng > Hải Phòng', 'phone'=>'01624563890'],
        	['id_emp'=>'3', 'name'=>'Lê Hải Yến', 'relationship'=>'Mẹ', 'date_of_birth'=>'1968-07-23', 'career'=>'Nông dân', 'address'=>'23 Nguyễn Trãi > Hồng Bàng > Hải Phòng', 'phone'=>''],
        	['id_emp'=>'3', 'name'=>'Nguyễn Lâm Toàn', 'relationship'=>'Anh trai', 'date_of_birth'=>'1989-06-12', 'career'=>'Giáo viên', 'address'=>'43 Hồng Quang > Hồng Bàng > Hải Phòng', 'phone'=>'098675412'],
        	['id_emp'=>'3', 'name'=>'Nguyễn Như Lan', 'relationship'=>'Em gái', 'date_of_birth'=>'1998-09-26', 'career'=>'Sinh viên', 'address'=>'23 Nguyễn Trãi > Hồng Bàng > Hải Phòng', 'phone'=>'0166528390'],
        	]);
    }
}
