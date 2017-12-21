<?php

use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permission_role')->insert([
        	['id_permission'=>1, 'id_role'=>2, 'created_at'=>new DateTime()],
        	['id_permission'=>2, 'id_role'=>2, 'created_at'=>new DateTime()],
        	['id_permission'=>2, 'id_role'=>3, 'created_at'=>new DateTime()],
        	['id_permission'=>3, 'id_role'=>2, 'created_at'=>new DateTime()],
        	['id_permission'=>4, 'id_role'=>1, 'created_at'=>new DateTime()],
        	['id_permission'=>4, 'id_role'=>2, 'created_at'=>new DateTime()],
        	['id_permission'=>4, 'id_role'=>3, 'created_at'=>new DateTime()],
        	]);
    }
}
