<?php
namespace Jiny\Shop\Goods\Http\Livewire;

use Illuminate\Support\Facades\Blade;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Webuni\FrontMatter\FrontMatter;
use Jiny\Pages\Http\Parsedown;
use \Jiny\Html\CTag;
use Illuminate\Http\Request;

class ShopProductCatalog extends Component
{
    public $slug;
    public $goods;

    public function mount(Request $request) {
        $this->slug = $request->slug;

        // 카테고리 ID로 모든 상품 조회
        $rows = DB::table('shop_products')
            ->where('category_id', $this->slug)
            ->get();

        // 배열로 변환
        $goods = $rows->map(function($row){
            return (array) $row;
        })->toArray();
        $this->goods = $goods;
    }

    public function render()
    {
        // dd($this->goods);
        return view('jiny-shop-goods::shop-electronics.product_catalog_list');
    }
}
