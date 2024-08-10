<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * shop 옵션 Table
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
        Schema::create('shop_option_type', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            // 옵션 활성화 여부
            $table->string('enable')->default(1);

            // 옵션 그룹명
            $table->string('type')->nullable();

            $table->string('name')->nullable();

            // 값
            $table->string('var')->nullable();

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
        Schema::dropIfExists('shop_option_type');
    }
};
