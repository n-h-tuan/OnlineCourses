<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDanhGiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('danh_gia', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('HoaDon_id')->unsigned()->index();
            $table->foreign('HoaDon_id')->references('id')->on('hoa_don')->onDelete('cascade');
            $table->string('TieuDe')->nullable();
            $table->text('NoiDung')->nullable();
            $table->integer('Diem');
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
        Schema::dropIfExists('danh_gia');
    }
}
