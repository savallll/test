<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use App\Models\menu;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function __construct(){
        $menu = DB::table('menu')
                ->select('*')
                ->get();
        $categories = DB::table('categories')
                ->select('*')
                ->get();
        View::share([
            'menu'=> $menu,
            'categories'=> $categories,
        ]); // <= Truyền dữ liệu
    }
}
