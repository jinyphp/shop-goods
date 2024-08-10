<?php
namespace Jiny\Shop\Goods\Http\Controllers\Shop;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

/**
 * 상품목록
 */
use Jiny\Site\Http\Controllers\SiteController;
class ShopGoodsList extends SiteController
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
        $actions['title'] = "상품목록";
        $actions['subtitle'] = "상품을 출력합니다.";

        // 레이아웃을 커스텀 변경합니다.
        $actions['view']['layout'] = "goods";

        $this->setReflectActions($actions);
    }


    public function index(Request $request)
    {
        return parent::index($request);
    }


}
