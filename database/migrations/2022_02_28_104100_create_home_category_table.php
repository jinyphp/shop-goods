<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * shop 내 홈페이지의 카테고리 Table
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
        Schema::create('home_category', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('ref')->default(0);
            $table->integer('level')->default(0);
            $table->integer('pos')->default(1);

            // 홈페이지의 탭의 카테고리
            $table->string('sel_categories');

            // 카테고리 내의 상품 개숫
            $table->integer('no_of_products');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('home_category');
    }
};
