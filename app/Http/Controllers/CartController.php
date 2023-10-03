<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\cart;
use App\Models\cart_product;
use Session;


class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id, Request $req)
    {
        //
        if (!cart::where('user_id', Session('user'))->exists()) {
            // ID không tồn tại
            $cart1 = new cart();
            $cart1->user_id = Session('user');
            $cart1->save();
        }

        $cart_id1 = DB::table('carts')
            ->where('user_id',Session('user'))
            ->value('id');
            // dd($cart_id1);

        if (!cart_product::where('product_id',$id)->exists()) {
            //sản phẩm không tồn tại
            $cart_product = new cart_product();
            $cart_product->cart_id = $cart_id1;
            $cart_product->product_id = $id;
            $cart_product->product_name = $req->input('name');
            $cart_product->product_price = $req->input('price');
            $cart_product->product_size = $req->input('size');
            $cart_product->quantity = $req->input('quantity');
            // $cart_product->save();
            if($cart_product->save()){
                return redirect()->back()->with('success', 'Thêm vào giỏ hàng thành công');
            }
        }else{
            try{
                cart_product::where('product_id',$id)->increment('quantity');
                return redirect()->back()->with('success', 'Thêm vào giỏ hàng thành công');
            }
            catch(\Exception $e){
                return redirect()->back()->withErrors(['mess'=>'Thêm thất bại']);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
