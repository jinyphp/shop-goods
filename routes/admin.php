<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

$shop_prefix = "shop";

/**
 * Admin 관리자
 */


## 인증 없이 접속가능한 경로 처리
Route::middleware(['web'])->group(function(){
    Route::get('/admin/shop/category', [
        \Jiny\Shop\Goods\Http\Controllers\Admin\AdminCategoryController::class,
        'index']);

    // 상품목록(내부상품)
    Route::get('/admin/shop/products', [
        \Jiny\Shop\Goods\Http\Controllers\Admin\AdminProductController::class,
        'index']);

    // 상품목록(외부상품)
    Route::get('/admin/shop/goods', [
            \Jiny\Shop\Goods\Http\Controllers\Admin\AdminGoodsController::class,
            'index']);

    // 상품별 가격이력을 담당합니다.
    Route::get('/admin/shop/product/price/type', [
        \Jiny\Shop\Goods\Http\Controllers\Admin\AdminPriceTypeController::class,
        'index']);

    // 상품별 가격이력을 담당합니다.
    Route::get('/admin/shop/product/prices', [
            \Jiny\Shop\Goods\Http\Controllers\Admin\AdminPriceController::class,
            'index']);

    ## 상품 연관 이미지
    Route::get('/admin/shop/goods/images', [
        \Jiny\Shop\Goods\Http\Controllers\Admin\AdminGoodsImageController::class,
        'index']);

    ## 상품옵션
    Route::get('/admin/shop/goods/options', [
        \Jiny\Shop\Goods\Http\Controllers\Admin\AdminOptionController::class,
        'index']);
    Route::get('/admin/shop/goods/options/{option}/item', [
            \Jiny\Shop\Goods\Http\Controllers\Admin\AdminOptionItemController::class,
            'index']);


    ## 할인행사
    Route::get('/admin/shop/onsale', [
        \Jiny\Shop\Goods\Http\Controllers\Admin\AdminOnsaleController::class,
        'index']);


    Route::get('/admin/shop/information', [
        \Jiny\Shop\Goods\Http\Controllers\Admin\AdminInformationController::class,
        'index']);

    ## 상품리뷰
    Route::get('/admin/shop/reviews', [
        \Jiny\Shop\Goods\Http\Controllers\Admin\AdminReviewController::class,
        'index']);

    ## 브렌드 관리
    Route::get('/admin/shop/brands', [
        \Jiny\Shop\Goods\Http\Controllers\Admin\AdminBrandController::class,
        'index']);


    Route::get('/admin/shop/productCategories', [
        \Jiny\Shop\Goods\Http\Controllers\Admin\AdminProductCategoryController::class,
        'index']);




    Route::get('/admin/shop/reviewLikes', [
        \Jiny\Shop\Goods\Http\Controllers\Admin\AdminReviewLikeController::class,
        'index']);

    Route::get('/admin/shop/productOption', [
        \Jiny\Shop\Goods\Http\Controllers\Admin\AdminProductOptionController::class,
        'index']);
    Route::get('/admin/shop/homeCategory', [
        \Jiny\Shop\Goods\Http\Controllers\Admin\AdminHomeCategoryController::class,
        'index']);
});
