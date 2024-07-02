<?php

namespace Jiny\Shop\Goods\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use Jiny\WireTable\Http\Controllers\WireTablePopupForms;
class AdminReviewLikeController extends WireTablePopupForms
{
    public function __construct()
    {
        parent::__construct();
        $this->setVisit($this);

        ##
        $this->actions['table'] = "shop_reviews_like"; // 테이블 정보

        $this->actions['view']['list'] = "jiny-shop-goods::admin.review_likes.list";
        $this->actions['view']['form'] = "jiny-shop-goods::admin.review_likes.form";

    }
}
