<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * <쇼핑몰 리뷰>
 * enable: 노출여부
 * product_id: 상품id
 * product: 상품이름
 * title: 리뷰 제목
 * review: 리뷰 내용
 * rank: 평점
 * user_id: 유저id
 * username: 유저이름
 * email: 유저이메일
 * password: 유저비밀번호
 * like: 좋아요
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
        Schema::create('shop_reviews', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('ref')->default(0);
            $table->integer('level')->default(0);
            $table->integer('pos')->default(1);

            $table->string('enable')->default(1);

            ## 상품명
            $table->string('goods')->nullable();

            $table->string('title')->nullable();
            $table->string('review')->nullable();

            $table->integer('rank')->default(0);

            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('username')->nullable();
            $table->string('email')->nullable();
            $table->string('password')->nullable();

            // 인증 사용자만 가능
            // shop_reviews_like 에 기록
            $table->integer('like')->default(0);




        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shop_reviews');
    }
};
