<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(LevelSeeder::class);
        // $this->call(UserSeeder::class);
        // $this->call(ThoiHanGVSeeder::class);
        // $this->call(ThanhToanSeeder::class);
        // $this->call(TheLoaiKhoaHocSeeder::class);
        // $this->call(MangKhoaHocSeeder::class);
        // $this->call(GiangVienSeeder::class);
        // $this->call(KhoaHocSeeder::class);
        $this->call(NganHangSeeder::class);
    }
}
