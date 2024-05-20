<?php

namespace Jiny\Shop\Goods\Http\Livewire;

use Illuminate\Support\Facades\Blade;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

use Webuni\FrontMatter\FrontMatter;
use Jiny\Pages\Http\Parsedown;

use \Jiny\Html\CTag;
use Jiny\Shop\Entities\ShopProducts;
use Cart;

class ShopRelatedProducts extends Component
{
    public $category_id;
    public $num = 4; // 출력 데이터 갯수

    public function render()
    {
        $relation_products = ShopProducts::where('category_id',$this->category_id)
            ->inRandomOrder()
            ->limit($this->num)
            ->get();

        return view('jiny-shop-goods::related.related', [
            'relation_products'=>$relation_products
        ]);
    }

}
