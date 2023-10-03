<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\product;
use App\Models\thumbnail;


class ProductController extends Controller
{
    //
    
    public function index($product_id){

        $product = DB::table('products')
        ->where('id', $product_id)
        ->select('*')
        ->get();

        // dd($product);
        
        //get related_products
        $related_products = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('menu', 'categories.menu_id', '=', 'menu.id')
            ->select('products.*')
            ->Where('menu.id', $product_id)
            ->get();
            // dd($related_products);

        //get thumbnail_product
        $thumbnail_product =DB::table('thumbnails')
            ->select('image')
            ->where('product_id',$product_id)
            ->get();
            // dd($thumbnail_product);

        return view('product.detail',[
            'product'=> $product,
            'related_products'=> $related_products,
            'thumbnail_product'=> $thumbnail_product
        ]);
     
    }
}
