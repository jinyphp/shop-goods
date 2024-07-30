<?php

use Brick\Math\BigInteger;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * 상품 리뷰 테이블
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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('ref')->default(0);
            $table->integer('level')->default(0);
            $table->integer('pos')->default(1);

            # 리뷰 텍스트
            $table->string('title');

            # 상품 별점 정보
            $table->integer('rating');

            # 리뷰 텍스트
            $table->text('comment');

            # 리뷰하는 상품의 ID
            $table->bigInteger('order_item_id')->unsigned();

            # 외래키 제약 조건 (상품 삭제시 리뷰까지 같이 삭제)
            $table->foreign('order_item_id')
                ->references('id')
            ->on('shop_order_items')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
};
