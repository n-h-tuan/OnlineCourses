<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaiKhoanNganHangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tai_khoan_ngan_hang', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('SoTaiKhoan',19)->unique();
            $table->string('ChuTaiKhoan');
            $table->integer('NganHang_id')->unsigned();
            $table->foreign('NganHang_id')->references('id')->on('ngan_hang')->onDelete('cascade');
            $table->string('ChiNhanhNganHang');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tai_khoan_ngan_hangs');
    }
}
