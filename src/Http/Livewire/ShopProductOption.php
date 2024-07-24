<?php
namespace Jiny\Shop\Goods\Http\Livewire;

use Illuminate\Support\Facades\Blade;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Webuni\FrontMatter\FrontMatter;
use Jiny\Pages\Http\Parsedown;
use \Jiny\Html\CTag;

//use Livewire\WithFileUploads;

// 상품 Gallery 옆에 상품 옵션 livewire
class ShopProductOption extends Component
{
    public $slug;

    public function mount(Request $request) {
        // Path Variable 저장
        $this->slug = $request->slug;
        // dd($this->slug);
    }

    public function render()
    {
        $row1 = DB::table('shop_products')->where('id', $this->slug)->get();
        $rows = DB::table('shop_goods_images')->where('goods',$this->slug)->get();

        $images = [];
        $images[] = $row1[0]->image;

        // 상품 대표이미지 + 상품등록이미지
        foreach ($rows as $row) {
            $images[] = $row->image;
        }

        // dd($images);
        $viewFile = 'jiny-shop-goods::shop-electronics.product_option';

        return view($viewFile, ['images'=>$images]);
    }
}
