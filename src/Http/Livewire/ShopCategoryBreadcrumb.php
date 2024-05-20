<?php

namespace Jiny\Shop\Goods\Http\Livewire;

use Illuminate\Support\Facades\Blade;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

use Webuni\FrontMatter\FrontMatter;
use Jiny\Pages\Http\Parsedown;

use Livewire\WithPagination;
use Jiny\Shop\Entities\ShopProducts;
//use Jiny\Shop\Entities\ShopCategory as Category;
use Cart;

class ShopCategoryBreadcrumb extends Component
{
    public $category;
    public $widget=[]; // 위젯정보
    public $breadcrumb=[];
    public $item;

    public function mount()
    {
        $this->load(); //데이터를 읽어옴
    }

    // 데이터를 읽어 옵니다.
    private function load()
    {
        $path = resource_path("/shop"); // 카테고리 리소스가 저장되어 있는 경로
        if(!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        if($this->category) {
            $filename = $path.DIRECTORY_SEPARATOR.$this->category.".json";
            if(file_exists($filename)) {
                $json = file_get_contents($filename);
                $widget = json_decode($json,true);
            }

            $widget['code'] = $this->category;
        }

        // 외부설정값 + 파일정보값 처리
        if($widget) {
            foreach($widget as $key => $item) {
                $this->widget[$key] = $item;
            }
        }

    }

    // 화면 랜더링
    public function render()
    {
        // 목록 생성
        $result = null;
        if($this->item) {
            if(isset($this->widget['items'])) {
                $result = $this->findCategory($this->widget['items'], $this->item);
                $this->makeBreadcrumb($result);
            }
        }

        //dump($this->widget['items']);
        //dump($this->breadcrumb);
        //dd($result);

        // 기본값
        $viewFile = 'jiny-shop-goods::products.breadcrumb';
        return view($viewFile);
    }

    private function makeBreadcrumb($result)
    {
        if($result['ref']) {
            $ref = $result['ref'];
            $this->makeBreadcrumb($this->widget['items'][$ref]);
        }

        $this->breadcrumb []= $result;
    }

    private function findCategory($node, $item)
    {
        foreach($node as $leaf) {
            if($leaf['name'] == $item) {
                return $leaf;
            }
        }
    }


    /*
    public $slug;
    public $category_id;
    public $category_name;

    public function render()
    {
        $slug = $this->slug;
        if(is_numeric($slug)) {
            $cate = DB::table('category_items')->where('id',$slug)->first();
        } else {
            $cate = DB::table('category_items')->where('slug',$slug)->first();
        }

        if($cate) {
            $this->category_name = $cate->title;
            $this->category_id = $cate->id;
        }

        return view('jiny-shop::shop.products.breadcrumb');
    }
    */

    /**
     * Popup Admin
     */
    /*
    public $admin;
    public $popup = false;
    public $forms;

    public function edit($id)
    {
        $this->popup = true;
        $this->category_id = $id;

        //dd($id);
        $row = DB::table('category_items')->where('id',$id)->first();
        foreach($row as $key => $value) {
            $this->forms[$key]=$value;
        }
    }

    public function update()
    {
        DB::table('category_items')
        ->where('id',$this->category_id)
        ->update($this->forms);

        $this->popup = false;
    }
    */

}
