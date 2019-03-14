<?php

use Illuminate\Database\Seeder;

class ThoiHanGVSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $TenThoiHan = array("3 tháng", "6 tháng" , "1 năm" , "Trọn đời");
        $ThoiGian = array(90, 180, 365, 9999999);
        $giaTien = array(100000 , 180000, 340000, 800000);
        for ($i=0; $i < count($TenThoiHan) ; $i++) { 
            DB::table('thoi_han_gv')->insert([
                'TenThoiHan' => $TenThoiHan[$i],
                'songay' => $ThoiGian[$i],
                'giatien' => $giaTien[$i],
                'created_at' => new DateTime(), 
            ]);
        }
    }
}
