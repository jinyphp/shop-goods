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
    public $ratingAvg;
    // 각 리뷰별 like, unlike 관리배열
    public $likeArr;
    // 상품 배열
    public $goods;
    public $ratio;
    public $viewFile;

    public function mount(Request $request, $viewFile) {

        // 변수 초기화
        $this->viewFile = $viewFile;
        $this->slug = $request->slug;
        $this->ratings = array(6);
        for ($i = 0; $i < 5; $i++) {
            $this->ratings[$i + 1] = 0;
            $this->ratio[$i+1] = 0;
        }

        // 리뷰 조회
        $rows = DB::table('reviews')
            ->join('shop_reviews_like', 'reviews.id', '=', 'shop_reviews_like.review_id')
            ->where('order_item_id', $this->slug)
            ->get();

        // dd($rows);

        // 배열로 변환
        $goods = $rows->map(function($row){
            $this->likeArr[$row->id] =  ['like'=> $row->like, 'unlike'=> $row->unlike];
            return (array) $row;
        })->toArray();
        $this->goods = $goods;

        // 상품에 대한 별점 정보 얻어와서 변수 세팅
        $data = getProductStarInfo($request->slug);
        $this->total_review = $data['totalReview'];
        $this->ratingAvg = $data['starAvg'];
        $this->ratings = $data['starCount'];

        // dd($data);
        // livewire에 event 발생
        $this->sendData();
        // dd($this->total_review);
        for ($i = 0; $i < 5; $i++) {
            if ($this->total_review != 0) {
                $this->ratio[$i+1] = $this->ratings[$i+1] / $this->total_review * 100;
            }
        }
        // dd($this->ratio);
    }

    public function render()
    {

        return view($this->viewFile);
    }

    // DB에 업데이트한 쿼리 조회
    public function updateLike($id) {
        $row = DB::table('shop_reviews_like')
        ->where('id', $id)
        ->first();

        // likeArr update
        $this->likeArr[$id]['like'] = $row->like;
        $this->likeArr[$id]['unlike'] = $row->unlike;

        // dd($row);
    }

    public function increaseLike($id){
        // 해당리뷰의 like 증가
        DB::table('shop_reviews_like')->where('id', $id)->increment('like');

        // 좋아요 다시 조회
        $this->updateLike($id);
    }

    public function increaseUnLike($id){
        // 해당리뷰의 unlike 증가
        DB::table('shop_reviews_like')->where('id', $id)->increment('unlike');

        // 좋아요 다시 조회
        $this->updateLike($id);
    }

    public function sendData()
    {
        $this->dispatch('dataSent', ['totalReview'=> $this->total_review, 'ratingAvg'=> $this->ratingAvg]);
    }
}
