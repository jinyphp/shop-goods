<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * shop 상품의 옵션 Table
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
        Schema::create('shop_products_option', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('ref')->default(0);
            $table->integer('level')->default(0);
            $table->integer('pos')->default(1);

            // 옵션활성화 여부
            $table->string('enable')->default(1);

            $table->unsignedBigInteger('product_id'); // 상품명
            $table->unsignedBigInteger('option_id'); // 옵션그룹

            // 필수선택
            $table->string('require')->default(1);

            // 만료일자
            $table->string('expire')->nullable();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shop_products_option');
    }
};
