<?php
namespace Jiny\Shop\Goods\Http\Livewire\Category;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

//use Modules\Shop\Entities\ShopCategory;


class Category extends Component
{
    public $slug;
    //public $cate_id;
    public $code_id;

    public function render()
    {
        if($this->code_id) {
            // 카테고리 정보 읽기
            $categories = DB::table('category_items')->where('cate_id', $this->code_id)->get();

            foreach($categories as $category) {
                if($category->slug == $this->slug) {
                    $category_id = $category->id;
                    $category_name = $category->title;
                }
            }

            return view("jiny-shop::category.category",['categories'=>$categories]);
        }

        return <<<'blade'
        <div class="alert alert-danger">
            카테고리 그룹 코드가 없습니다.
        </div>
    blade;

    }





}
