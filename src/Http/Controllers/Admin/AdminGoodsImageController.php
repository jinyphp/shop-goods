<?php
namespace Jiny\Shop\Goods\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

/**
 * 상품 연관 이미지
 */
use Jiny\WireTable\Http\Controllers\WireTablePopupForms;
class AdminGoodsImageController extends WireTablePopupForms
{
    public function __construct()
    {
        parent::__construct();
        $this->setVisit($this);

        ##
        $this->actions['table'] = "shop_goods_images"; // 테이블 정보

        $this->actions['view']['list'] = "jiny-shop-goods::admin.goods_images.list";
        $this->actions['view']['form'] = "jiny-shop-goods::admin.goods_images.form";

        ## 타이틀 제목
        $this->actions['title'] = "연관 상품 이미지";
        $this->actions['subtitle'] = "상품의 추가 이미지를 관리합니다.";

        ## 레이아웃을 커스텀 변경합니다.
        $this->actions['view']['layout'] = "jiny-shop-goods::admin.goods_images.layout";

    }
}
