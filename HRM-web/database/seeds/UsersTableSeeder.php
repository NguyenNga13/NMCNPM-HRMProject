<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	// DB::table('Type')->insert([
        DB::table('users')->insert([
        	['name'=>'1', 'email'=>'a@gmail.com', 'password'=> encrypt('123456')],
        	['name'=>'2', 'email'=>'b@gmail.com', 'password'=> encrypt('123456')],
            ['name'=>'3', 'email'=>'c@gamil.com', 'password'=> encrypt('123456')]

        	]);

    }
}
