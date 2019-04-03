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
        DB::table('users')->insert([
            'name' => "Admin",
            'email' => "admin@gmail.com",
            'password' => bcrypt('123456'),
            'level_id' => 1,
            'created_at' => new DateTime(),

        ]);
        for($i = 1; $i <= 5;$i++)
        {
        	DB::table('users')->insert(
	        	[
	        		'name' => 'User_'.$i,
	            	'email' => 'user_'.$i.'@gmail.com',
	            	'password' => bcrypt('123456'),
                    'level_id'=> 3,
                    'hinhanh' => Str::random(6).".jpg",
	            	'created_at' => new DateTime(),
	        	]
        	);
        }
    }
}
