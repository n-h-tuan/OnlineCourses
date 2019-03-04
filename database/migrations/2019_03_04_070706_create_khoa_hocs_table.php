<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKhoaHocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('khoa_hoc', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('mangKH_id')->unsigned();
            $table->foreign('mangKH_id')->references('id')->on('mang_khoa_hoc')->onDelete('cascade');
            $table->integer('giangvien_id')->unsigned();
            $table->foreign('giangvien_id')->references('id')->on('giang_vien')->onDelete('cascade');
            $table->string('hinhanh');
            $table->string('tenKH');
            $table->longText('tomtat');
            $table->float('giatien',9,2);
            $table->integer('danhgia');
            $table->integer('soluotxem');
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
        Schema::dropIfExists('khoa_hoc');
    }
}
