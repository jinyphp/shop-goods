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
    public $unlikeCount;
    public $slug;

    public function mount(Request $request) {
        $this->slug = $request->slug;
        // dd($product['id']);
    }

    public function render()
    {
        // $rows = DB::table('reviews')->where('order_item_id',$this->slug)->get();
        // dump($rows);
        $rows = DB::table('reviews')
            ->join('shop_reviews_like', 'reviews.id', '=', 'shop_reviews_like.review_id')
            ->get();

        // dd($rows);

        // 배열로 변환
        $goods = $rows->map(function($row){
            return (array) $row;
        })->toArray();
        // dd($goods);
        // $this->likeCount = $goods['like'];
        // $this->likeCount = $goods['unlike'];

        $viewFile = 'jiny-shop-goods::shop-electronics.product_review';

        return view($viewFile, ['goods'=>$goods]);
    }

    public function increaseLike(){
        $this->likeCount += 1;
    }

    public function increaseUnLike(){
        $this->unlikeCount += 1;
    }
}
