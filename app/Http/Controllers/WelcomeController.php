<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminModel;
use App\Models\UserModel;
use Session;

class WelcomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function login()
    {
        return view('login');
    }

    public function login_admin()
    {
        return view('login-admin');
    }

    public function register()
    {
        return view('register');
    }

    public function do_login(Request $request){
        //cek username
        $cek_user = UserModel::where('username', $request->username)->first();
        if(empty($cek_user)){
            return redirect()->back()->with('status', 'Akun tidak terdaftar!');
        }

        //cek password
        if(!password_verify($request->password, $cek_user->password)){
            return redirect()->back()->with('status', 'Username / password salah!');
        }

        Session::put('id', $cek_user->user_id);
        Session::put('email', $cek_user->email);
        Session::put('nama', $cek_user->nama);

        if ($request->redirect_back) {
            return redirect()->back();
        }

        return redirect('/');
    }

    public function do_login_admin(Request $request){
        //cek username
        $cek_user = AdminModel::where('username', $request->username)->first();
        if(empty($cek_user)){
            return redirect()->back()->with('status', 'Akun tidak terdaftar!');
        }

        //cek password
        if(!password_verify($request->password, $cek_user->password)){
            return redirect()->back()->with('status', 'Username / password salah!');
        }

        Session::put('id', $cek_user->id_admin);
        Session::put('email', $cek_user->email);
        Session::put('nama', $cek_user->nama);

        if ($request->redirect_back) {
            // return redirect()->back();
        }

        return redirect('/admin');
    }

    public function do_register(Request $request){
        $user               = new UserModel();
        $user->username     = $request->username;
        $user->password     = password_hash($request->password, PASSWORD_DEFAULT);
        $user->email        = $request->email;
        $user->no_hp        = $request->nohp;
        $user->nama         = $request->nama;
        $user->alamat       = $request->alamat;

        if ($user->save()) {
            return redirect('login')->with('status', "Selamat, akun Anda telah terdaftar!");;
        }else{
            return redirect()->back()->with('status', "Gagal menambahkan User.");
        }
    }

    public function do_logout(){
        Session::flush();
        return redirect('/');
    }
}
