<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBaiGiangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bai_giang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('KhoaHoc_id')->unsigned()->index();
            $table->foreign('KhoaHoc_id')->references('id')->on('khoa_hoc')->onDelete('cascade');
            $table->string('TenBaiGiang');
            $table->longText('MoTa')->nullable();
            $table->string('EmbededURL')->unique();
            $table->smallInteger('HocThu')->nullable(); // 0: Không ----- 1: Có
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
        Schema::dropIfExists('bai_giang');
    }
}
