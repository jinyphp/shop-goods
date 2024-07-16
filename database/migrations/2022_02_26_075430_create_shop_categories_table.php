<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * shop 내 카테고리 Table
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_categories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('ref')->default(0);
            $table->integer('level')->default(0);
            $table->integer('pos')->default(1);

            ## 활성화
            $table->string('enable')->nullable();

            ## 카테고리 이름
            $table->string('name')->nullable();

            ## uri에서 카테고리를 식별하기 위한 문자열
            $table->string('slug')->nullable();

            ## 카테고리 등록 상품수
            $table->integer('goods')->default(0);

            ## 카테고리 관리자 아이디
            $table->string('manager')->nullable();

            ## 카테고리 설명
            $table->text('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shop_categories');
    }
};
