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
    public $slug;
    // 총 review 수
    public $total_review;
    // 1 ~5 변점 counting 배열
    public $ratings;
    // review 별점 평균
    public $rating_avg;
    // 각 리뷰별 like, unlike 관리배열
    public $likeArr;
    // 상품 배열
    public $goods;

    public function mount(Request $request) {
        // 변수 초기화
        $this->slug = $request->slug;
        $this->ratings = array(6);
        for ($i = 0; $i < 5; $i++) {
            $this->ratings[$i + 1] = 0;
        }

        // 리뷰 조회
        $rows = DB::table('reviews')
            ->join('shop_reviews_like', 'reviews.id', '=', 'shop_reviews_like.review_id')
            ->get();

        // dd($rows);

        // 배열로 변환
        $goods = $rows->map(function($row){
            $this->ratings[$row->rating]++;
            $this->rating_avg += $row->rating;
            $this->likeArr[$row->id] =  ['like'=> $row->like, 'unlike'=> $row->unlike];
            return (array) $row;
        })->toArray();
        $this->goods = $goods;

        // total_review 수 계산
        $this->total_review = count($goods);

        // review 평점 평균
        $this->rating_avg =  round($this->rating_avg /  $this->total_review, 1);
    }

    public function render()
    {

        // dd($goods);

        $viewFile = 'jiny-shop-goods::shop-electronics.product_review';

        return view($viewFile);
    }

    public function increaseLike($id){
        // 해당리뷰의 like 증가
        $this->likeArr[$id]['like']++;
    }

    public function increaseUnLike($id){
        // 해당리뷰의 unlike 증가
        $this->likeArr[$id]['unlike']++;
    }
}
