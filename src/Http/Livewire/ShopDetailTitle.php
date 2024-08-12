<?php
namespace Jiny\Shop\Goods\Http\Livewire;

use Illuminate\Support\Facades\Blade;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Livewire\Attributes\On;

class ShopDetailTitle extends Component
{
    public $actions = [];
    public $slug;


    public $viewFile;

    public $popupForm = false;
    public $forms = []; // 상품의 정보

    // 라이브와이어 생성자
    public function mount()
    {
        if(!$this->viewFile) {
            $this->viewFile = "jiny-shop-goods::detail_v2.title";
        }

        // 인자로 slug가 없는 경우, uri를 분석
        if(!$this->slug) {
            $current_url = Request::url();
            $urls = array_reverse(explode('/',$current_url));

            // 코드 추출
            if(isset($urls[0]) && is_string($urls[0])) {
                $slug = $urls[0];
                $this->slug = $urls[0];
            }
        } else {
            $slug = $this->slug;
        }


        if (is_numeric($slug)) {
            $goods = DB::table('shop_goods')
                ->where('id',$slug)->first();
        }  else {
            $goods = DB::table('shop_goods')
                ->where('slug',$slug)->first();
        }

        // 객체를 배열로 변환
        foreach($goods as $key => $value) {
            $this->forms[$key] = $value;
        }

    }



    public function render()
    {
        if($this->popupForm) {
            return view($this->viewFile."_edit", []);
        }

        return view($this->viewFile, []);
    }


    public function cancel()
    {
        $this->setup = false;
        $this->popupForm = false;
    }

    ## 수정 편집
    public function modify()
    {
        $this->popupForm = true;
    }

    ## 수정 데이터 갱신
    public function update()
    {
        $id = $this->forms['id'];

        DB::table('shop_goods')
            ->where('id', $id)
            ->update($this->forms);

        $this->popupForm = false;
    }

}
