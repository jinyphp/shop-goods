<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('ref')->default(0);
            $table->integer('level')->default(0);
            $table->integer('pos')->default(1);

            $table->string('enable')->default(1);   // 활성화
            $table->string('expire')->nullable();   // 기간이 만료되면 판매가 중된됩니다.

            ## 상품명 및 설명
            $table->string('slug')->unique()->nullable();
            $table->string('name')->nullable();

            $table->string('subtitle')->nullable();
            $table->string('short_description')->nullable();
            $table->text('description')->nullable();

            ## price
            $table->decimal('regular_price')->nullable();
            $table->decimal('sale_price')->nullable();
            $table->string('unit_price')->nullable();   // 단체 가격
            $table->string('option_price')->nullable(); // 옵션 가격
            $table->string('event_price')->nullable();  // 이벤트 가격

            $table->string('refund')->nullable();   // 반품허용 여부
            $table->string('buy')->nullable();  // 되팔기 허용



            $table->string('SKU')->nullable();
            $table->enum('stock_status',['instock','soldout'])->default('soldout');
            $table->boolean('featured')->default(false);
            $table->unsignedInteger('quantity')->default(10);

            $table->string('image')->nullable();

            $table->bigInteger('category_id')->unsigned()->nullable();

            //$table->foreign('category_id')->references('id')->on('shop_categories')->onDelete('cascade');

            // 옵션
            $table->string('option')->nullable();


            //배송
            $table->string('shipping_free')->nullable(); // 무료배송

            // 도서상품
            $table->string('author')->nullable();
            $table->string('translator')->nullable();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shop_products');
    }
};
