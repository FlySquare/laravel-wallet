<?php

namespace App\Http\Controllers;

use App\Models\users;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Testing\Fluent\Concerns\Has;

class UserAuth extends Controller
{
    public function loginIndex(Request $request)
    {
        return view('login');
    }

    public function logout(Request $request)
    {
        Session::flush();
        return redirect('login');
    }

    public function registerIndex()
    {
        return view('register');
    }
    public function registerPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|min:3|unique:users,user_username',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6'
        ]);
        if ($validator->fails()) {
            return redirect('register')
                ->withErrors($validator)
                ->withInput();
        }
        $user = new users();
        $user->user_username = $request->input('username');
        $user->user_password = md5(md5(md5($request->input('password'))));
        $user->user_lastlogin = date('Y-m-d H:i:s');
        $user->user_lastip = \Illuminate\Support\Facades\Request::ip();
        if($user->save()){
            $cards = new \App\Models\cards();
            $cards->card_name = "Nakit";
            $cards->card_balance = "0";
            $cards->card_owner = $user->user_id;
            $cards->save();
            $request->session()->put('user_id', Crypt::encryptString($user->user_id));
            return redirect('/');
        }else{
            return redirect('register')->withErrors(['Kullanıcı eklenirken bir hata meydana geldi!']);
        }

    }

    public function loginPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required|min:6'
        ]);
        if ($validator->fails()) {
            return redirect('login')
                ->withErrors($validator)
                ->withInput();
        }
        $user = users::where('user_username', '=', $request->input('username'))
            ->where('user_password', '=', md5(md5(md5($request->input('password')))))
            ->first();
        if ($user == null) {
            return redirect('login')
                ->withErrors(['no_user' => 'Kullanıcı adı veya şifre hatalı']);
        } else {
            $userUpdate = users::find($user->user_id);
            $userUpdate->user_lastlogin = date('Y-m-d H:i:s');
            $userUpdate->save();
            $request->session()->put('user_id', Crypt::encryptString($user->user_id));
            return redirect('/');
        }
    }
}
