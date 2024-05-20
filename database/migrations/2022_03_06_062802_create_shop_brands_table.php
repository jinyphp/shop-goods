<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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

            $table->string('enable')->default(1);

            $table->string('name');
            $table->string('link')->nullable();

            // 이미지 또는 svg
            $table->string('type')->default('image');
            $table->string('image')->nullable();
            $table->string('svg')->nullable();

            // 브랜드 업체정보
            $table->string('manager')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();

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
