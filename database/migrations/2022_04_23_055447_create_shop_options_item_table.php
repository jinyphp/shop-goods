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
        Schema::create('shop_options_item', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('ref')->default(0);
            $table->integer('level')->default(0);
            $table->integer('pos')->default(1);

            $table->unsignedBigInteger('option_id')->nullable();

            $table->string('enable')->default(1);
            $table->string('name'); // 옵션이름

            $table->string('value')->nullable();

            $table->string('stock')->nullable();
            $table->string('price')->nullable(); // 지정가격, + , -



            $table->unsignedBigInteger('nested')->default(0);

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
        Schema::dropIfExists('shop_options_item');
    }
};
