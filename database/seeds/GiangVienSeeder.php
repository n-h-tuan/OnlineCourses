<?php

use Illuminate\Database\Seeder;
// use Faker\Provider\tr_TR\DateTime;

class GiangVienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('giang_vien')->insert([
            ['user_id'=> 2, 
            'TenGiangVien' => "GV_1", 
            'TomTat'=>"Tôi là giảng viên GV_1",
            'thoihanGV_id' => rand(1,4),
            'TrangThai' => 1,
            'created_at' => new DateTime()],
            ['user_id'=> 3, 
            'TenGiangVien' => "GV_2", 
            'TomTat'=>"Tôi là giảng viên GV_2",
            'thoihanGV_id' => rand(1,4),
            'TrangThai' => 1,
            'created_at' => new DateTime()],

            ['user_id'=> 4, 
            'TenGiangVien' => "GV_3", 
            'TomTat'=>"Tôi là giảng viên GV_3",
            'thoihanGV_id' => rand(1,4),
            'TrangThai' => 1,
            'created_at' => new DateTime()]
        ]);
        // for ($i=0; $i < 5; $i++) { 
        //     DB::table('giang_vien')->insert([
        //         'user_id' => rand(2,10),
        //         'TenGiangVien' => "GV_".$i,
        //         'tomtat' => "Tôi là giảng viên ".$i,
        //         'SoLuongHocVien' => rand(10,50),
        //         'SoLuongKhoaHoc' => rand(1,10),
        //         'thoihanGV_id' => rand(1,4),
        //         'TrangThai' => 1,
        //         'created_at' => new DateTime(),
        //     ]);
        // }
    }
}
