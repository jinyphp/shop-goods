<?php
namespace Jiny\Shop\Goods\Http\Livewire;

use Illuminate\Support\Facades\Blade;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

use Webuni\FrontMatter\FrontMatter;
use Jiny\Pages\Http\Parsedown;

use \Jiny\Html\CTag;

use Jiny\Shop\Entities\ShopSliders;

use Livewire\WithFileUploads;
use Livewire\Attributes\On;
use Illuminate\Http\Request;

class ShopProductSliderUploadDrag extends Component
{
    public $path = "/images/goods";
    public $category;
    public $slug;

    public function render(Request $request)
    {
        // 이미지에 어떤 상품id의 이미지인지 파싱(Request url로)
        $slug = explode("/", $request->url());
        $this->slug = end($slug);

        $viewFile = 'jiny-shop-goods::products.slider_upload_drag';
        return view($viewFile);
    }

}
