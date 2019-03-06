<?php

use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $level = array("Admin","Giảng Viên","Người Dùng Thường");
        for ($i=0; $i < 3; $i++) { 
            DB::table('level')->insert([
                'tenlevel' => $level[$i],
                'created_at' => new DateTime(),
            ]);
        }
    }
}
