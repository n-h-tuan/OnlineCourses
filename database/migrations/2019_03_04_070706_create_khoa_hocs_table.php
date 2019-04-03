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
            $table->integer('MangKH_id')->unsigned()->index();
            $table->foreign('MangKH_id')->references('id')->on('mang_khoa_hoc')->onDelete('cascade');
            $table->integer('GiangVien_id')->unsigned()->index();
            $table->foreign('GiangVien_id')->references('id')->on('giang_vien')->onDelete('cascade');
            $table->string('HinhAnh')->nullable();
            $table->string('TenKH');
            $table->longText('TomTat');
            $table->float('GiaTien',9,0);
            $table->integer('GiamGia')->default(0)->nullable();
            $table->float('ThanhTien',9,0)->nullable();
            $table->integer('DanhGia')->default(0);
            $table->integer('SoLuotXem')->default(0);
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
