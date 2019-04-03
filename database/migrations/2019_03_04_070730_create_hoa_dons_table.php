<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHoaDonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hoa_don', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('KhoaHoc_id')->unsigned()->index();
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('KhoaHoc_id')->references('id')->on('khoa_hoc')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('ThanhToan_id')->unsigned()->index();
            $table->foreign('ThanhToan_id')->references('id')->on('thanh_toan')->onDelete('cascade');
            $table->integer('TongTien');
            $table->integer('MaCode_id')->unsigned()->nullable();
            $table->foreign('MaCode_id')->references('id')->on('code_khoa_hoc')->onDelete('cascade');
            $table->integer('TrangThai')->default(0);
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
        Schema::dropIfExists('hoa_don');
    }
}
