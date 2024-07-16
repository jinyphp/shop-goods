<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

$shop_prefix = "shop";

Route::middleware(['web'])
->name($shop_prefix)
->prefix($shop_prefix)->group(function () {

    // 상품목록
    Route::get('/products/{slug?}', [
        \Jiny\Shop\Goods\Http\Controllers\ProductsController::class,
        "index"])
        ->name('shop.products');

    // 상품 상세
    Route::get('/detail/{slug}', [
        \Jiny\Shop\Goods\Http\Controllers\DetailController::class,
        "index"]);

    // 카테고리 목록
    Route::get('/category', [
        \Jiny\Shop\Http\Controllers\CategoryController::class,
        "index"])->name('shop.category');

        Route::get('/search', [
            \Jiny\Shop\Http\Controllers\SearchProductsController::class,
            "index"])->name('shop.search');


        Route::get('/reviews/{slug}', [
            \Jiny\Shop\Http\Controllers\ReviewsController::class,
            "index"]);


    Route::get('/brand', [
        \Jiny\Shop\Goods\Http\Controllers\BrandController::class,
        "index"]);
});

/**
 * dropzone 파일 업로드 api
 * CSRF 토큰적용을 위해서 미들웨어 web 통과.
 */
use Jiny\Shop\Http\Controllers\Admin\ProductUploadController;
Route::middleware(['web'])
->group(function(){
    Route::post('/api/shop/product/drop',[
        ProductUploadController::class,
        "dropzone"]);
    Route::post('/api/shop/product/images',[ProductUploadController::class,"images"]);
});


/**
 * Admin 관리자
 */
Route::middleware(['auth:sanctum','verified'])->group(function(){

    Route::resource('/shop/admin/reviews',
        \Jiny\Shop\Http\Controllers\Admin\AdminReviewController::class);

    Route::get('/shop/admin/options', [
        \Jiny\Shop\Http\Controllers\Admin\AdminOptions::class,'index']);

    Route::get('/shop/admin/options/item/{id}', [
        \Jiny\Shop\Http\Controllers\Admin\AdminOptionsItem::class,'index']);

    Route::resource('/shop/admin/seller',
        \Jiny\Shop\Http\Controllers\Admin\AdminSellerController::class);

});

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
