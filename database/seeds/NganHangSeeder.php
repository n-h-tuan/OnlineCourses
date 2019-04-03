<?php

use Illuminate\Database\Seeder;

class NganHangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ngan_hang')->insert([
            ['TenNganHang' => ""],
        ]);
    }
}
