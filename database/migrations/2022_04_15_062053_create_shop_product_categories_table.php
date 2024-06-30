<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


/**
 * shop의 상품의 카테고리 테이블
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
        Schema::create('shop_product_categories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('ref')->default(0);
            $table->integer('level')->default(0);
            $table->integer('pos')->default(1);

            $table->bigInteger('product_id'); // 제품 번호
            $table->bigInteger('category_id'); // 카테고리 번호


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shop_product_categories');
    }
};
