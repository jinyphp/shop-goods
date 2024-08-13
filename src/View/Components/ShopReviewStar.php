<?php
namespace Jiny\Shop\Goods\View\Components;

use Illuminate\View\Component;

class ShopReviewStar extends Component
{
    public $value;
    public $viewFile;

    public function __construct($value=0, $viewFile=null)
    {
        $this->value = $value; // 평점

        if($viewFile) {
            $this->viewFile = $viewFile;
        } else {
            $this->viewFile = "jiny-shop-goods::components.shop_review_star";
        }
    }

    public function render()
    {
        return view($this->viewFile);
    }
}
