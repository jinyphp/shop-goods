<?php
namespace Jiny\Shop\Goods\Http\Livewire;

use Illuminate\Support\Facades\Blade;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Webuni\FrontMatter\FrontMatter;
use Jiny\Pages\Http\Parsedown;
use \Jiny\Html\CTag;

//use Livewire\WithFileUploads;

class ShopProductReview extends Component
{
    public $likeCount;

    public function mount() {
        $this->likeCount = 0;
    }

    public function render()
    {

        // dd($rows);
        return view('jiny-shop-goods::detail.productReview');
    }

    public function increaseLike(){
        $this->likeCount += 1;
    }
}
