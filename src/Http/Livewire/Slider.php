<?php
namespace Jiny\Shop\Goods\Http\Livewire;

use Illuminate\Support\Facades\Blade;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Webuni\FrontMatter\FrontMatter;
use Jiny\Pages\Http\Parsedown;
use \Jiny\Html\CTag;
use Illuminate\Support\Facades\Request;

// use Jiny\Shop\Entities\ShopSliders;

//use Livewire\WithFileUploads;

class Slider extends Component
{
    //use WithFileUploads;
    //use \Jiny\WireTable\Http\Trait\Upload;
    public $slug;
    public $product;
    public $viewFile;

    public function mount($viewFile) {

        // 멤버 변수에 할당
        $this->viewFile = $viewFile;

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

        // dd($this->slug);

        $product = array();

        //상품 메인이미지 가져오기
        $rows = DB::table('shop_goods')
        ->where('id',$this->slug)->first();

        $product[] = $rows->image;

        //상품에 대한 이미지 가져오기
        $rows = DB::table('shop_goods_images')
            ->where('goods',$this->slug)->get();

        //배열로 변환
        foreach ($rows as $row) {
            $product[] = $row->image;
        }

        $this->product = $product;

    }

    public function render()
    {
        // dd($this->product);
        return view($this->viewFile,[
            'product' => $this->product
        ]);
    }
}
