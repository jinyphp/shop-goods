<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * shop의 정보가 담겨 있는 테이블
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
        Schema::create('shop_information', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('ref')->default(0);
            $table->integer('level')->default(0);
            $table->integer('pos')->default(1);

            #shop의 폐업 여부(장사하고 있는지 안하고 있는지)
            $table->string('enable')->default("false");

            #shop의 이름
            $table->string('name');

            #shop의 전화번호
            $table->string('number')->nullable();

            #shop의 security_mananager 정보
            $table->string('security_manager')->nullable();

            #shop의 domain
            $table->string('domain')->nullable();

            #shop의 email
            $table->string('email')->nullable();

            #shop의 전화번호
            $table->string('phone')->nullable();

            #shop의 전화번호2
            $table->string('phone2')->nullable();

            #shop의 주소
            $table->string('address')->nullable();

            #shop의 지도
            $table->string('map')->nullable();

            #shop의 트위터 주소
            $table->string('twiter')->nullable();

            #shop의 페이스북 주소
            $table->string('facebook')->nullable();

            #shop의 pinterest 주소
            $table->string('pinterest')->nullable();

            #shop의 인스타그램 주소
            $table->string('instagram')->nullable();

            #shop의 유튜브 주소
            $table->string('youtube')->nullable();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shop_information');
    }
};
