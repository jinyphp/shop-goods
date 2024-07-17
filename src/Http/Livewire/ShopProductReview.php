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

class ShopProductReview extends Component
{
    public $likeCount;
    public $slug;
    public $productId;

    public function mount($product) {
        $this->likeCount = 0;
        $this->productId = $product['id'];
        // dd($product['id']);
    }

    public function render()
    {
        $rows = DB::table('reviews')->where('order_item_id',$this->productId)->get();
        // dump($rows);

        // 배열로 변환
        $goods = $rows->map(function($row){
            return (array) $row;
        })->toArray();
        // dd($goods);

        return view('jiny-shop-goods::detail.productReview', ['rows'=>$goods]);
    }

    public function increaseLike(){
        $this->likeCount += 1;
    }
}
