<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Session;


class LoginController extends Controller
{
    public function index(){
        return view('account.login');
    }
    public function register(){
        return view('account.register');
    }
    public function register_submit(Request $req){
        $acc1 = new User();
        $acc1 ->name =$req->input('name');
        $acc1 ->email =$req->input('email');
        $acc1 ->password =$req->input('password');
        $acc1 ->save();
        return redirect('/login');
    }
    public function auth(Request $req){
        
        // $credentials = $req->only('email', 'password');
        $userdata = [    
            'email' => $req->input('email'),
            'password' => $req->input('password')
        ];

        //session user
        $id_user = DB::table('users')
            ->select('id')
            ->where('email',$userdata['email'])
            ->get();
            // dd($id_user);
        $data = json_decode($id_user, true);
        $id = $data[0]['id'];
        $req->session()->put('user', $id);

        if (Auth::attempt($userdata)) {
            // Đăng nhập thành công, thực hiện hành động mong muốn
            return redirect()->intended('/');
        }
        // Đăng nhập thất bại, hiển thị thông báo lỗi
        return back()->withErrors([
            'email' => 'Thông tin không hợp lệ',
        ]);
    }

    public function logout(){
        // Session::forget('user');
        session::flush();
        return redirect('/');
    }
    
}
