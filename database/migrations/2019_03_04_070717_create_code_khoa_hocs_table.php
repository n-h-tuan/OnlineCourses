<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCodeKhoaHocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('code_khoa_hoc', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique();
            $table->integer('KhoaHoc_id')->unsigned()->index();
            $table->foreign('KhoaHoc_id')->references('id')->on('khoa_hoc')->onDelete('cascade');
            $table->integer('TrangThai'); //0: used ------ 1: not used
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
        Schema::dropIfExists('code_khoa_hoc');
    }
}
