<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * 상품별 옵션정보
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
        Schema::create('shop_goods_option', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            // 상품번호
            $table->unsignedBigInteger('goods_id')->nullable();

            // 옵션타입
            // color, size등등
            $table->string('type')->nullable();


            // 옵션 활성화 여부
            $table->string('enable')->default(1);
            $table->string('name')->nullable(); // 옵션이름
            $table->string('var')->nullable(); // 옵션값
            $table->string('image')->nullable(); // 옵션 이미지
            $table->string('price')->nullable(); // 옵션 가격


            $table->string('stock')->nullable(); // 아이탬 재고

            // 옵션 설명
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
        Schema::dropIfExists('shop_goods_option');
    }
};
