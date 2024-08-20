<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/**
 * dropzone 파일 업로드 api
 * CSRF 토큰적용을 위해서 미들웨어 web 통과.
 */
use Jiny\Shop\Goods\Http\Controllers\Admin\ProductUploadController;
use Jiny\Shop\Goods\Http\Controllers\Admin\ProductSliderUploadController;
Route::middleware(['web'])
->group(function(){
    Route::get('/api/shop/product/drop',[
        ProductUploadController::class,
        "index"]);

    ## ajax 파일을 업로드 합니다.
    Route::post('/api/shop/product/drop',[
        ProductUploadController::class,
        "dropzone"]);

    ## ajax 파일을 업로드 합니다.
    Route::post('/api/shop/product/sliderdrop',[
        ProductSliderUploadController::class,
        "dropzone"]);


    ## 업로드한 이미지를 출력합니다.
    Route::post('/api/shop/product/images',[
        ProductUploadController::class,
        "images"]);
});
