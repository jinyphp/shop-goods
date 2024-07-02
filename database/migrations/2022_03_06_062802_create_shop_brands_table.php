<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


/**
 * shop의 브랜드 테이블
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
        Schema::create('shop_brands', function (Blueprint $table) {

            $table->id();
            $table->timestamps();
            $table->integer('ref')->default(0);
            $table->integer('level')->default(0);
            $table->integer('pos')->default(1);

            # 브랜드 허용(영업) 상태
            $table->string('enable')->default(1);

            # 브랜드 이름
            $table->string('name');

            # 브랜드 링크
            $table->string('link')->nullable();

            // 이미지 또는 svg
            $table->string('type')->default('image');
            $table->string('image')->nullable();
            $table->string('svg')->nullable();

            // 브랜드 업체정보
            $table->string('manager')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();

            // 브랜드 상세 설명
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
        Schema::dropIfExists('shop_brands');
    }
};
