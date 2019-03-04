<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGiangViensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('giang_vien', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('TenGiangVien');
            $table->longText('tomtat');
            $table->integer('SoLuongHocVien');
            $table->integer('SoLuongKhoaHoc');
            $table->integer('thoihanGV_id')->unsigned();
            $table->foreign('thoihanGV_id')->references('id')->on('thoi_han_gv')->onDelete('cascade');
            $table->dateTime('NgayHetHan');
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
        Schema::dropIfExists('giang_vien');
    }
}
