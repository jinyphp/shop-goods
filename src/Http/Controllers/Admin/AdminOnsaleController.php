<?php
namespace Jiny\Shop\Goods\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


/**
 * 행사 진행
 */
use Jiny\WireTable\Http\Controllers\WireTablePopupForms;
class AdminOnsaleController extends WireTablePopupForms
{
    public function __construct()
    {
        parent::__construct();
        $this->setVisit($this);

        ##
        $this->actions['table'] = "shop_onsale"; // 테이블 정보

        //$this->actions['view_title'] = "jiny-shop::admin.category.title";
        //$this->actions['view_filter'] = "jiny-shop::admin.category.filter";
        $this->actions['view']['list'] = "jiny-shop-goods::admin.onsale.list";
        $this->actions['view']['form'] = "jiny-shop-goods::admin.onsale.form";

        $this->actions['title'] = "세일진행";
        $this->actions['subtitle'] = "기간을 정해서 할인 행사를 진행합니다.";

    }
}
