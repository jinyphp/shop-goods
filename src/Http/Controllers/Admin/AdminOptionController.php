<?php
namespace Jiny\Shop\Goods\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

/**
 * 상품 옵션 관리
 */
use Jiny\WireTable\Http\Controllers\WireTablePopupForms;
class AdminOptionController extends WireTablePopupForms
{
    public function __construct()
    {
        parent::__construct();
        $this->setVisit($this);

        ##
        $this->actions['table'] = "shop_options"; // 테이블 정보

        $this->actions['view']['list'] = "jiny-shop-goods::admin.option.list";
        $this->actions['view']['form'] = "jiny-shop-goods::admin.option.form";

        $this->actions['title'] = "상품 옵션관리";
        $this->actions['subtitle'] = "상품의 선택옵션을 그룹화 하여 관리합니다.";

    }
}
