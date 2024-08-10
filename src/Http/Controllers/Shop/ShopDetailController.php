<?php
namespace Jiny\Shop\Goods\Http\Controllers\Shop;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

/**
 * 상품상세
 */
use Jiny\Site\Http\Controllers\SiteController;
class ShopDetailController extends SiteController
{

    public function __construct()
    {
        parent::__construct();
        $this->setVisit($this);

        ## actions 기본설정 동작처리
        $this->setActions();
    }

    private function setActions()
    {
        $actions['title'] = "상품상세";
        $actions['subtitle'] = "상품 상세 정보입니다.";

        // 레이아웃을 커스텀 변경합니다.
        $actions['view']['layout'] = "goods_detail";

        $this->setReflectActions($actions);
    }


    public function index(Request $request)
    {
        return parent::index($request);
    }

    // public function index(Request $request)
    // {



    //     $slug = $request->slug;
    //     // dump($slug);
    //     if (is_numeric($slug)) {
    //         $product = DB::table('shop_products')->where('id',$slug)->first();
    //     } else {
    //         $product = DB::table('shop_products')->where('slug',$slug)->first();
    //     }
    //     // dump($product);
    //     // 배열 변환
    //     $good = [];

    //     foreach($product as $key => $value) {
    //         $good[$key] = $value;
    //     }
    //     // dd($good);



    //     $viewFile = 'www::shop-electronics.shop-product-general-electronics';

    //     // 임시 초기화
    //     $cart_idx = null;

    //     return view($viewFile, [
    //         'admin'=>$this->admin,
    //         'product'=>$good,
    //         'slug'=>$slug,
    //         'cartidx'=>$cart_idx

    //     ]);
    // }
}
