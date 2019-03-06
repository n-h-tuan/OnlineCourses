<?php

use Illuminate\Database\Seeder;
// use Faker\Provider\zh_TW\DateTime;

class TheLoaiKhoaHocSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('the_loai_khoa_hoc')->insert([
            ['tentheloai'=>'Công nghệ thông tin', 'created_at'=>new DateTime()],
            ['tentheloai'=>'Kinh tế', 'created_at'=>new DateTime()],
            ['tentheloai'=>'Giáo dục', 'created_at'=>new DateTime()],
            ['tentheloai'=>'Y tế', 'created_at'=>new DateTime()],
            ['tentheloai'=>'Âm nhạc', 'created_at'=>new DateTime()],

        ]);
    }
}
