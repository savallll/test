<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\category;
use App\Models\handbook;
use App\Models\menu;
use App\Models\menu_item;



class CategoryController extends Controller
{
    //
    public function index($category){
        //name, image from menu and categories
        $menu_detail = DB::table('menu')
                    ->where('name',$category)
                    ->select('name','image','id');
        $category_detail = DB::table('categories')
                    ->where('name',$category)
                    ->select('name','image','menu_id')
                    ->union($menu_detail)
                    ->get();
            // dd();
        
        // //select id category
        $menu_id =DB::table('menu')
                    ->where('name','=',$category)
                    ->select('id');
            // dd($menu_id);
        $categories_id =DB::table('categories')
        ->where('name','=',$category)
        ->select('menu_id')
        ->union($menu_id)
        ->get();
            // return $categories_id;

        // get id from $categories_id
        $data = json_decode($categories_id, true);
        $id = $data[0]['menu_id'];
            // return $id;

        //get list category
        $list_category = DB::table('categories')
        ->where('menu_id',$id)
        ->select('name')
        ->get();

        //get products
        $products = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('menu', 'categories.menu_id', '=', 'menu.id')
            ->select('products.*')
            ->where('categories.name', $category)
            ->orWhere('menu.name', $category)
            ->get();
            // dd($products);

        // random 5 products
        $related_products = DB::table('products')
            ->inRandomOrder()
            ->take(5)
            ->get();

        // $handbook = handbook::select('created_at')->get();
        $handbook = DB::table('handbook')
                ->select('*')
                ->get();
            // dd($handbook);  

        return view('category.index',[
            'category'=> $category_detail,
            'list_category'=> $list_category,
            'products'=> $products,
            'related_products'=> $related_products,
            'handbook'=> $handbook
        ]);
    }
}
