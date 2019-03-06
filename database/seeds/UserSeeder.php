<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for($i = 1; $i <= 10;$i++)
        {
        	DB::table('users')->insert(
	        	[
	        		'name' => 'User_'.$i,
	            	'email' => 'user_'.$i.'@mymail.com',
	            	'password' => bcrypt('123456'),
                    'level_id'=> rand(1,2),
                    'hinhanh' => Str::random(6).".jpg",
	            	'created_at' => new DateTime(),
	        	]
        	);
        }
    }
}
