<?php
namespace Jiny\Shop\Goods\Http\Livewire\Category;

use Livewire\Component;
use Illuminate\Support\Facades\DB;


class WidgetCategoryHero extends Component
{
    public $cate;
    public $cate_id;
    //public $hero;

    public function render()
    {
        if($this->cate) {
            $viewFile = 'category'.".".$this->cate['id'].".hero";
        } else {
            $viewFile = "category.hero";
        }

        if(view()->exists($viewFile)) {
            return view($viewFile);
        }

        return view("jiny-shop-goods::category.none");

    }





}
