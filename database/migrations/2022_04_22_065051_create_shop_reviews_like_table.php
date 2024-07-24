<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * shop 리뷰의 좋아요 Table
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
        Schema::create('shop_reviews_like', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('ref')->default(0);
            $table->integer('level')->default(0);
            $table->integer('pos')->default(1);

            // 리뷰 id
            $table->unsignedBigInteger('review_id')->nullable();

            // user id
            $table->unsignedBigInteger('user_id')->nullable();

            // user 이름
            $table->string('username')->nullable();

            // user 이메일
            $table->string('email')->nullable();

            // 좋아요 수
            $table->unsignedBigInteger('like')->default(0);

            // 싫어요 수
            $table->unsignedBigInteger('unlike')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shop_reviews_like');
    }
};
