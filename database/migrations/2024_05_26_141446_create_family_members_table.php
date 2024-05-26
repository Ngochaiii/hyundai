<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('family_members', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Khóa ngoại liên kết với bảng user_hrs
            $table->string('ma_chi_tiet')->nullable();
            $table->string('ho_ten')->nullable();
            $table->date('nam_sinh')->nullable();
            $table->string('nghe_nghiep')->nullable();
            $table->string('noi_o')->nullable();
            $table->string('quan_he')->nullable();
            // Các trường thông tin bổ sung khác
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('user__hrs')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('family_members');
    }
};
