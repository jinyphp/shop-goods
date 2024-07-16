<?php
namespace Jiny\Shop\Goods\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

/**
 * 쇼핑몰 관리자: 상품 가격 유형
 */
use Jiny\WireTable\Http\Controllers\WireTablePopupForms;
class AdminPriceTypeController extends WireTablePopupForms
{
    public function __construct()
    {
        parent::__construct();
        $this->setVisit($this);

        ## 연결 테이블을 지정합니다.
        $this->actions['table'] = "shop_price_type";

        ## 테이블을 출력합니다.
        $this->actions['view']['filter'] = "jiny-shop-goods::admin.price_type.filter";
        $this->actions['view']['list'] = "jiny-shop-goods::admin.price_type.list";
        $this->actions['view']['form'] = "jiny-shop-goods::admin.price_type.form";

        $this->actions['title'] = "쇼핑몰 상품 가격유형";
        $this->actions['subtitle'] = "가격 유형을 지정합니다.";

    }

    // Hook
    // 신규 데이터 DB 삽입전에 호출됩니다.
    public function hookStoring($wire, $form)
    {
        //$form['slug'] = Str::slug($form['name']);
        return $form;
    }

    public function hookStored($wire, $form)
    {
        //$id = $form['id'];
        //session()->flash('message',"카테고리가 성공적으로 추가 되어 있습니다.");
    }

    // 수정된 데이터가 DB에 적용되기 전
    public function hookUpdating($wire, $form, $old)
    {
        return $form;
    }


}
