<?php

namespace Jiny\Shop\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use Jiny\WireTable\Http\Controllers\WireTablePopupForms;
class AdminProductController extends WireTablePopupForms
{
    public function __construct()
    {
        parent::__construct();
        $this->setVisit($this);

        ##
        $this->actions['table'] = "shop_products"; // 테이블 정보

        //$this->actions['view_title'] = "jiny-shop::admin.category.title";
        //$this->actions['view_filter'] = "jiny-shop::admin.category.filter";
        $this->actions['view_list'] = "jiny-shop::admin.products.list";
        $this->actions['view_form'] = "jiny-shop::admin.products.form";

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
