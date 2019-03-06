<?php

use Illuminate\Database\Seeder;
// use Faker\Provider\zh_TW\DateTime;

class MangKhoaHocSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mang_khoa_hoc')->insert([
            ['theloaiKH_id'=>1,'tenmangKH'=>'Đồ họa','created_at'=> new DateTime()],
            ['theloaiKH_id'=>1,'tenmangKH'=>'Phần cứng','created_at'=> new DateTime()],
            ['theloaiKH_id'=>1,'tenmangKH'=>'Phần mềm','created_at'=> new DateTime()],
            ['theloaiKH_id'=>1,'tenmangKH'=>'Mạng máy tính','created_at'=> new DateTime()],
            ['theloaiKH_id'=>2,'tenmangKH'=>'Tài chính','created_at'=> new DateTime()],
            ['theloaiKH_id'=>2,'tenmangKH'=>'Sales','created_at'=> new DateTime()],
            ['theloaiKH_id'=>2,'tenmangKH'=>'Chiến lược kinh tế','created_at'=> new DateTime()],
            ['theloaiKH_id'=>3,'tenmangKH'=>'Toán học','created_at'=> new DateTime()],
            ['theloaiKH_id'=>3,'tenmangKH'=>'Khoa học','created_at'=> new DateTime()],
            ['theloaiKH_id'=>3,'tenmangKH'=>'Ngôn ngữ học','created_at'=> new DateTime()],
            ['theloaiKH_id'=>4,'tenmangKH'=>'Dinh dưỡng','created_at'=> new DateTime()],
            ['theloaiKH_id'=>4,'tenmangKH'=>'Yoga-Fitness','created_at'=> new DateTime()],
            ['theloaiKH_id'=>4,'tenmangKH'=>'Sơ cứu','created_at'=> new DateTime()],
            ['theloaiKH_id'=>5,'tenmangKH'=>'Thanh nhạc','created_at'=> new DateTime()],
            ['theloaiKH_id'=>5,'tenmangKH'=>'Kỹ thuật nhạc cổ điển','created_at'=> new DateTime()],
            ['theloaiKH_id'=>5,'tenmangKH'=>'Phần mềm âm nhạc','created_at'=> new DateTime()],
        ]);
    }
}
