<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMangKhoaHocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mang_khoa_hoc', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('theloaiKH_id')->unsigned();
            $table->foreign('theloaiKH_id')->references('id')->on('the_loai_khoa_hoc')->onDelete('cascade');
            $table->string('tenmangKH');
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
        Schema::dropIfExists('mang_khoa_hoc');
    }
}
