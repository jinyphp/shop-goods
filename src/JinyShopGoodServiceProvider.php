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
        $this->loadViewsFrom(__DIR__.'/../resources/views', $this->package);

        // 데이터베이스
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        // 설정파일 복사
        $this->publishes([
            __DIR__.'/../config/setting.php' => config_path('jiny/shop/goods.php'),
        ]);

        // 새로운 상품을 drag하여 등록합니다.
        Blade::component(\Jiny\Shop\Goods\View\Components\ShopDropzone::class, "shop-dropzone");


    }

    public function register()
    {
        /* 라이브와이어 컴포넌트 등록 */
        $this->app->afterResolving(BladeCompiler::class, function () {

            //test용
            Livewire::component('ShopProductSlider',
            \Jiny\Shop\Goods\Http\Livewire\Slider::class);

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

            Livewire::component('shop-brand',
                \Jiny\Shop\Goods\Http\Livewire\ShopBrands::class);


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

        });



    }
}
