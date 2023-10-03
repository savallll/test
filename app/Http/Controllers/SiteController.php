<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\menu;
use App\Models\baner;


class SiteController extends Controller
{

    public function index(){
        
        $banner = DB::table('baners')
                ->select('*')
                ->get();

        $handbook = DB::table('handbook')
        ->select('*')
        ->get();
            // dd($handbook);

        return view('home-page',[
            'banner'=> $banner,
            'handbook'=> $handbook
        ]);
    }
}
