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
class AdminOptionItemController extends WireTablePopupForms
{
    public function __construct()
    {
        parent::__construct();
        $this->setVisit($this);

        ##
        $this->actions['table'] = "shop_options_item"; // 테이블 정보

        $this->actions['view']['list'] = "jiny-shop-goods::admin.option_item.list";
        $this->actions['view']['form'] = "jiny-shop-goods::admin.option_item.form";

        $this->actions['title'] = "옵션목록";
        $this->actions['subtitle'] = "선택한 옵션의 상세 항목입니다.";

    }
}
