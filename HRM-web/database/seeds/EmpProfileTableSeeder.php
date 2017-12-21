<?php

use Illuminate\Database\Seeder;

class EmpProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call('EmpProfile');
    }
}


class EmpProfile extends Seeder
{

    // id_emp  name    profile_number  photo_card  gender  date_of_birth   place_of_birth  identity_card   id_issued_by    id_date_of_issued   passport_number passport_issued_by  passport_date_of_issued passport_expiration_date    country ethnic  religion    household_address   address telephone   phone   email   marial_status   date_of_adherent    social_ins  health_ins  bank_account    note
	public function run()
    {
        DB::table('emp_profiles')->insert([
        	['name'=>'Nguyễn A', 'profile_number'=>'20150001', 'photo_card'=>'N0001.jpg', 'gender'=>'1', 'date_of_birth'=>'1990-02-24', 'place_of_birth'=>'Hoàng Mai, Hà Nội', 'identity_card'=>'142712863', 'id_issued_by'=>'Hà Nội', 'id_date_of_issued'=>'2006-02-20', 'country'=>'Việt Nam', 'ethnic'=>'Kinh', 'religion'=>'Không', 'household_address'=>'Thịnh Liệt, Hoàng Mai, Hà Nội', 'address'=>'19B ngách 1197/23 Thịnh Liệt, Hoàng Mai, Hà Nội', 'phone'=>'01633359627', 'email'=>'a@gmail.com', 'marial_status'=>'0', 'social_ins'=>'5410005346', 'health_ins'=>'GD2637100081239', 'bank_account'=>'711A744900', 'created_at' => new DateTime()],
        	['name'=>'Nguyễn B', 'profile_number'=>'20150002', 'photo_card'=>'N0002.jpg', 'gender'=>'1', 'date_of_birth'=>'1990-02-24', 'place_of_birth'=>'Hoàng Mai, Hà Nội','identity_card'=>'142522863', 'id_issued_by'=>'Hà Nội', 'id_date_of_issued'=>'2006-01-10', 'country'=>'Việt Nam', 'ethnic'=>'Kinh', 'religion'=>'Không', 'household_address'=>'Thịnh Liệt, Hoàng Mai, Hà Nội', 'address'=>'Lĩnh Nam, Hoàng Mai, Hà Nội', 'phone'=>'0987026237', 'email'=>'b@gmail.com', 'marial_status'=>'1', 'social_ins'=>'5908005346', 'health_ins'=>'GD2657100981789', 'bank_account'=>'711AB44120','created_at' => new DateTime()],
        	['name'=>'Nguyễn C', 'profile_number'=>'20150003', 'photo_card'=>'N0003.jpg', 'gender'=>'0', 'date_of_birth'=>'1987-05-24', 'place_of_birth'=>'Kim Thành, Hải Dương','identity_card'=>'142522363', 'id_issued_by'=>'Hải Dương', 'id_date_of_issued'=>'2000-05-20', 'country'=>'Việt Nam', 'ethnic'=>'Kinh', 'religion'=>'Không', 'household_address'=>'Kim Thành, Hải Dương', 'address'=>'Phú Thái, Kim Thành, Hải Dương', 'phone'=>'0988339627', 'email'=>'c@gmail.com', 'marial_status'=>'0', 'social_ins'=>'2410975346', 'health_ins'=>'GD2639876581239', 'bank_account'=>'723A712969','created_at' => new DateTime()] ,
        	]);

    }

}