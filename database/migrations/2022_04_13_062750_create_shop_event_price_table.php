<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * <이벤트 정보>
 * enable: 노출 여부
 * product_id: 상품 id
 * product: 상품 이름
 * type: 할인 타입
 * discount: 할인가
 * max_count: 최대 판매수량
 * expire: 만료일자
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
        Schema::create('shop_event_price', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('ref')->default(0);
            $table->integer('level')->default(0);
            $table->integer('pos')->default(1);

            $table->string('enable')->default(1);

            $table->bigInteger('product_id');           // 상품id
            $table->string('product')->nullable();      // 상품명

            $table->string('type')->nullable();         // 할인유형
            $table->string('discount')->nullable();     // 할인값

            $table->integer('max_count')->nullable();   // 최대 판매수량
            $table->string('expire')->nullable();       // 만료일자


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shop_event_price');
    }
};
