<?php
namespace Jiny\Shop\Goods;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Compilers\BladeCompiler;
use Livewire\Livewire;

class JinyShopGoodServiceProvider extends ServiceProvider
{
    private $package = "jiny-shop-goods";
    public function boot()
    {
        // 모듈: 라우트 설정
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', $this->package);

        // 데이터베이스
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        // 설정파일 복사
        $this->publishes([
            __DIR__.'/../config/setting.php' => config_path('jiny/shop/goods.php'),
        ]);

        // 새로운 상품을 drag하여 등록합니다.
        Blade::component(\Jiny\Shop\Goods\View\Components\ShopDropzone::class, "shop-dropzone");

        // review star
        Blade::component(\Jiny\Shop\Goods\View\Components\ShopReviewStar::class, "shop-review-star");
    }

    public function register()
    {
        /* 라이브와이어 컴포넌트 등록 */
        $this->app->afterResolving(BladeCompiler::class, function () {

            // Electronics 분리용 컴포넌트
            Livewire::component('product-gallery',
            \Jiny\Shop\Goods\Http\Livewire\ShopProductGallery::class);

            Livewire::component('product-option',
            \Jiny\Shop\Goods\Http\Livewire\ShopProductOption::class);

            Livewire::component('product-catalog',
            \Jiny\Shop\Goods\Http\Livewire\ShopProductCatalog::class);

            Livewire::component('product-nav-reviews',
            \Jiny\Shop\Goods\Http\Livewire\ShopProductNavReviews::class);

            // shop product 리뷰 페이지
            Livewire::component('product-review',
            \Jiny\Shop\Goods\Http\Livewire\ShopProductReview::class);

            //test용
            Livewire::component('ShopProductSlider',
            \Jiny\Shop\Goods\Http\Livewire\Slider::class);

            ## 상품 목록을 출력합니다.
            Livewire::component('shop-product-list',
                \Jiny\Shop\Goods\Http\Livewire\ShopProductList::class);




            Livewire::component('ShopProductImage',
                \Jiny\Shop\Goods\Http\Livewire\ShopProductImage::class);

            Livewire::component('ShopProductDetail',
                \Jiny\Shop\Goods\Http\Livewire\ShopProductDetail::class);

            Livewire::component('ShopProductDescription',
                \Jiny\Shop\Goods\Http\Livewire\ShopProductDescription::class);

            Livewire::component('ShopProductInformation',
                \Jiny\Shop\Goods\Http\Livewire\ShopProductInformation::class);

            // shop 브랜드 관련
            Livewire::component('shop-brand',
                \Jiny\Shop\Goods\Http\Livewire\ShopBrands::class);



            // Drag 상품올리기
            Livewire::component('shop-product-slider-upload-drag',
                \Jiny\Shop\Goods\Http\Livewire\ShopProductSliderUploadDrag::class);

            // Drag 상품올리기
            Livewire::component('shop-product-upload-drag',
                \Jiny\Shop\Goods\Http\Livewire\ShopProductUploadDrag::class);


            // 연관상품목록
            Livewire::component('shop-related-products',
                \Jiny\Shop\Goods\Http\Livewire\ShopRelatedProducts::class);


            // 카테고리
            Livewire::component('shop-category',
                \Jiny\Shop\Goods\Http\Livewire\Category\ShopWidgetCategory::class); // json으로 카테고리 설정
            Livewire::component('AdminWireCateDrag',
                \Jiny\Shop\Goods\Http\Livewire\Category\AdminWireCateDrag::class);
            Livewire::component('AdminCatePopupFrom',
                \Jiny\Shop\Goods\Http\Livewire\Category\AdminCatePopupFrom::class);
            Livewire::component('Category',
                \Jiny\Shop\Goods\Http\Livewire\Category\Category::class);
            Livewire::component('WidgetCategoryHero',
                \Jiny\Shop\Goods\Http\Livewire\Category\WidgetCategoryHero::class);

            // 상품 카테고리 breadcrumb
            Livewire::component('shop-category-breadcrumb',
                \Jiny\Shop\Goods\Http\Livewire\ShopCategoryBreadcrumb::class);


            Livewire::component('admin-shop-prices',
                \Jiny\Shop\Goods\Http\Livewire\AdminShopPrices::class);
        });


        /* 라이브와이어 컴포넌트 등록 */
        ## 상품목록_v2
        $this->app->afterResolving(BladeCompiler::class, function () {
            Livewire::component('shop-goods-list',
                \Jiny\Shop\Goods\Http\Livewire\ShopGoodsList::class);

            // 상품목록 사이드바, 브랜드 필터링
            Livewire::component('shop-brand-filter',
                \Jiny\Shop\Goods\Http\Livewire\ShopBrandsFilter::class);

            Livewire::component('shop-price-filter',
                \Jiny\Shop\Goods\Http\Livewire\ShopPriceFilter::class);

            Livewire::component('shop-option-filter',
                \Jiny\Shop\Goods\Http\Livewire\ShopOptionFilter::class);


        });

        /* 라이브와이어 컴포넌트 등록 */
        ## 상품상세_v2
        $this->app->afterResolving(BladeCompiler::class, function () {
            // 상품 상세 타이틀
            Livewire::component('shop-detail-title',
                \Jiny\Shop\Goods\Http\Livewire\ShopDetailTitle::class);

            // 상품 상세 가격
            Livewire::component('shop-detail-price',
                \Jiny\Shop\Goods\Http\Livewire\ShopDetailPrice::class);

            // 상품 상세 옵션
            Livewire::component('shop-detail-option',
                \Jiny\Shop\Goods\Http\Livewire\ShopDetailOption::class);

            // 상품 상세 주문처리
            Livewire::component('shop-detail-cart',
                \Jiny\Shop\Goods\Http\Livewire\ShopDetailCart::class);

            // Livewire::component('shop-goods-info',
            //     \Jiny\Shop\Goods\Http\Livewire\ShopGoodsInfo::class);
        });



    }
}
