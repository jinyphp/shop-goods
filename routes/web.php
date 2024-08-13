<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

$shop_prefix = "shop";

Route::middleware(['web'])
->name($shop_prefix)
->prefix($shop_prefix)->group(function () {

    // 카트질라 전자 테스트용
    Route::get('/home-electronics', [
        \Jiny\Shop\Goods\Http\Controllers\Cartzilla\ElecController::class,
        "index"])
        ->name('shop.elec');

    Route::get('/shop-product-general-electronics', [
        \Jiny\Shop\Goods\Http\Controllers\Cartzilla\ShopProductGeneralElectronicsController::class,
        "index"])
        ->name('shop.elec1');

    Route::get('/shop-categories-electronics', [
        \Jiny\Shop\Goods\Http\Controllers\Cartzilla\ShopCategoriesElectronicsController::class,
        "index"])
        ->name('shop.elec2');

    Route::get('/shop-catalog-electronics', [
        \Jiny\Shop\Goods\Http\Controllers\Cartzilla\ShopCatalogElectronicsController::class,
        "index"])
        ->name('shop.elec3');

    Route::get('/shop-product-details-electronics', [
        \Jiny\Shop\Goods\Http\Controllers\Cartzilla\ShopGoodsDetailsElectronicsController::class,
        "index"])
        ->name('shop.elec4');

    Route::get('/shop-product-reviews-electronics', [
        \Jiny\Shop\Goods\Http\Controllers\Cartzilla\ShopProductReviewsElectronicsController::class,
        "index"])
        ->name('shop.elec5');

    Route::get('/404-electronics', [
        \Jiny\Shop\Goods\Http\Controllers\Cartzilla\ErrorElectronicsController::class,
        "index"])
        ->name('shop.elec6');

    Route::get('/home-fashion-v2', [
        \Jiny\Shop\Goods\Http\Controllers\Cartzilla\HomeFashionV2Controller::class,
        "index"])
        ->name('shop.fashion1');

    Route::get('/shop-product-fashion', [
        \Jiny\Shop\Goods\Http\Controllers\Cartzilla\ShopProductFashionController::class,
        "index"])
        ->name('shop.fashion2');

    Route::get('/shop-catalog-fashion', [
        \Jiny\Shop\Goods\Http\Controllers\Cartzilla\ShopCatalogFashionController::class,
        "index"])
        ->name('shop.fashion3');
        // accout 관련
    Route::get('/account-signin', [
        \Jiny\Shop\Goods\Http\Controllers\Cartzilla\ShopSignInController::class,
        "index"])
        ->name('shop.login');

    Route::get('/account-signup', [
        \Jiny\Shop\Goods\Http\Controllers\Cartzilla\ShopSignUpController::class,
        "index"])
        ->name('shop.login');
    Route::get('/help-topics-v1', [
        \Jiny\Shop\Goods\Http\Controllers\Cartzilla\ShopHelpTopicsController::class,
        "index"])
        ->name('shop.login');
    Route::get('/account-password-recovery', [
        \Jiny\Shop\Goods\Http\Controllers\Cartzilla\ShopPasswordController::class,
        "index"])
        ->name('shop.login');

    Route::get('/help-single-article-v1', [
        \Jiny\Shop\Goods\Http\Controllers\Cartzilla\ArticleV1Controller::class,
        "index"])
        ->name('shop.login');
    // 카트질라 테스트용



    // 특정 상품카테고리목록
    // Route::get('/products/{slug?}', [
    //     \Jiny\Shop\Goods\Http\Controllers\SpecificProductsController::class,
    //     "index"])
    //     ->name('shop.products');

    // 상품 상세
    // Route::get('/detail/{slug}', [
    //     \Jiny\Shop\Goods\Http\Controllers\DetailController::class,
    //     "index"]);

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

Route::middleware(['web'])
->group(function(){

    Route::get('/goods/{slug?}', [
        \Jiny\Shop\Goods\Http\Controllers\Shop\ShopGoodsList::class,
        "index"])
        ->name('shop.goods');

    // 상품 상세
    Route::get('/detail/{slug}', [
        \Jiny\Shop\Goods\Http\Controllers\Shop\ShopDetailController::class,
        "index"]);
});




include(__DIR__.DIRECTORY_SEPARATOR."admin.php");
