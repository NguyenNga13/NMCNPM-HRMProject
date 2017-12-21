<?php

use Illuminate\Database\Seeder;

class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_user')->insert([
        	['id_role'=>1, 'id_user'=>1, 'created_at'=>new DateTime()],
        	['id_role'=>2, 'id_user'=>1, 'created_at'=>new DateTime()],
        	['id_role'=>3, 'id_user'=>1, 'created_at'=>new DateTime()],
        	['id_role'=>2, 'id_user'=>2, 'created_at'=>new DateTime()],
        	['id_role'=>2, 'id_user'=>3, 'created_at'=>new DateTime()],
        	['id_role'=>3, 'id_user'=>3, 'created_at'=>new DateTime()],
        	]);
    }
}
