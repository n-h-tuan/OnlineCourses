<?php

use Illuminate\Database\Seeder;
// use Faker\Provider\zh_CN\DateTime;

class ThanhToanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('thanh_toan')->insert([
            ['HinhThucThanhToan'=>'Chuyển khoản','created_at'=> new DateTime()],
            ['HinhThucThanhToan'=>'Ship COD', 'created_at'=> new DateTime()],
        ]);
    }
}
