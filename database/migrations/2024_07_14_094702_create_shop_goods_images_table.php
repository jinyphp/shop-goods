<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * shop의 상품의 이미지 관련 테이블
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
        Schema::create('shop_goods_images', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            ## 활성화된 이미지만 출력합니다.
            $table->string('enable')->default(1);

            ## 연결상품
            $table->string('goods')->nullable();

            ## image 타입
            ## image일 경우 img 테그로 출력
            ## video일 경우 video 테그로 출력
            $table->string('type')->default('image');

            ## image url
            $table->string('image')->nullable();

            ## 이미지 출력 우선순위
            $table->integer('pos')->default(1);

            ## 설명
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
        Schema::dropIfExists('shop_goods_images');
    }
};
