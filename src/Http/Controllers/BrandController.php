<?php
namespace Jiny\Shop\Goods\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class BrandController extends Controller
{
    public $admin;
    public function __construct()
    {
        $this->admin = true;
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $viewFile = 'jiny-shop-goods::brand.layout';
        return view($viewFile, [
            'admin'=>$this->admin
        ]);
    }
}
