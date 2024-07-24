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

// shop-electronics slider이미지 화면
class ShopProductGallery extends Component
{
    public $slug;

    public function mount(Request $request) {
        // Path Variable 저장
        $this->slug = $request->slug;
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
        $viewFile = 'jiny-shop-goods::shop-electronics.product_gallery';

        return view($viewFile, ['images'=>$images]);
    }
}
