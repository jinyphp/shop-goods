<?php
namespace Jiny\Shop\Goods\Http\Livewire;

use Illuminate\Support\Facades\Blade;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Webuni\FrontMatter\FrontMatter;
use Jiny\Pages\Http\Parsedown;
use \Jiny\Html\CTag;



class ShopProductNavReviews extends Component
{
    public $slug;
    public $totalReview;
    public $ratingAvg;
    protected $listeners = ['dataSent' => 'handleDataSent'];

    public function mount(Request $request) {
        // Path Variable 저장
        $this->slug = $request->slug;
        // dd($this->slug);
    }

    public function render()
    {

        // 리뷰 조회
        // $rows = DB::table('reviews')
        //     ->where('order_item_id', $this->slug)
        //     ->get();

        // $this->totalReview = count($rows);

        $viewFile = 'jiny-shop-goods::shop-electronics.product_nav_reviews';

        return view($viewFile);
    }

    public function handleDataSent($data) {
        $this->totalReview = $data['totalReview'];
        $this->ratingAvg = $data['ratingAvg'];
    }
}
