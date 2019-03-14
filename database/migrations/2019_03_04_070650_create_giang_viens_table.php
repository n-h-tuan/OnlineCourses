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
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('TenGiangVien');
            $table->longText('TomTat');
            $table->integer('SoLuongHocVien');
            $table->integer('SoLuongKhoaHoc');
            $table->integer('ThoiHanGV_id')->unsigned()->index();
            $table->foreign('ThoiHanGV_id')->references('id')->on('thoi_han_gv')->onDelete('cascade');
            $table->string('NgayHetHan')->nullable();
            $table->integer('TrangThai'); //0:Hết thời hạn ---- 1:Còn thời hạn
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
