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

class ShopProductUploadDrag extends Component
{
    public $path = "/images/products";
    public $category;

    public function render()
    {
        $viewFile = 'jiny-shop-goods::products.upload_drag';
        return view($viewFile);
    }

}
