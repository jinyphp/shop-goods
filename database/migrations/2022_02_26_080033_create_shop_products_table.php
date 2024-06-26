<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


/**
 * shop 내 상품 Table
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
        Schema::create('shop_products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            # shop 내 상품의 트리 구조 표현
            $table->integer('ref')->default(0);
            $table->integer('level')->default(0);
            $table->integer('pos')->default(1);

            # 상품 보이는지 활성화 여부
            $table->string('enable')->default(1);   // 활성화

            # 상품 판매 기간 설정
            $table->string('expire')->nullable();   // 기간이 만료되면 판매가 중된됩니다.

            # 특정 리소스나 페이지를 식별하는 데 사용되는 URL 친화적인 문자열
            $table->string('slug')->unique()->nullable();

            # 상품 이름
            $table->string('name')->nullable();

            # 상품 설명 subtitle
            $table->string('subtitle')->nullable();

            # 상품에 대한 짧은 설명
            $table->string('short_description')->nullable();

            # 상품에 대한 긴 설명
            $table->text('description')->nullable();

            ## 정가
            $table->decimal('regular_price')->nullable();

            # 할인가
            $table->decimal('sale_price')->nullable();

            # 단체 가격
            $table->string('unit_price')->nullable();   // 단체 가격

            # 옵션 가격
            $table->string('option_price')->nullable(); // 옵션 가격

            # 이벤트 가격
            $table->string('event_price')->nullable();  // 이벤트 가격

            # 상품 반품 허용 여부
            $table->string('refund')->nullable();   // 반품허용 여부

            # resell 허용 여부
            $table->string('buy')->nullable();  // 되팔기 허용


            # 재고 관리를 위한 고유 식별자
            $table->string('SKU')->nullable();

            # 상품의 재고 여부(instock -> 재고 있음, soldout -> 다팔림)
            $table->enum('stock_status',['instock','soldout'])->default('soldout');

            # 상품 행사 여부
            $table->boolean('featured')->default(false);

            # 상품 수량
            $table->unsignedInteger('quantity')->default(10);

            # 상품 이미지
            $table->string('image')->nullable();

            # 상품의 카테고리 id
            $table->bigInteger('category_id')->unsigned()->nullable();

            //$table->foreign('category_id')->references('id')->on('shop_categories')->onDelete('cascade');

            // 상품 옵션
            $table->string('option')->nullable();


            //상품 무료 배송 여부
            $table->string('shipping_free')->nullable(); // 무료배송

            // 도서상품의 경우 저자
            $table->string('author')->nullable();

            // 도서상품의 경우 번역자
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
