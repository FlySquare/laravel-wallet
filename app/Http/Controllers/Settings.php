<?php

namespace App\Http\Controllers;

use App\Models\users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Settings extends Controller
{
    public function index()
    {
        return view('settings');
    }

    public function changeUsernamePost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|min:3|unique:users,user_username'
        ]);
        if ($validator->fails()) {
            return redirect('settings')
                ->withErrors($validator)
                ->withInput();
        }
        $changeUsername = users::find($request->currentUser->user_id);
        $changeUsername->user_username = $request->input('username');
        if ($changeUsername->save()) {
            return redirect('settings')->with(['message' => 'Kullanıcı adınız başarıyla değiştirildi!']);
        } else {
            return redirect('settings')
                ->withErrors(['Kullanıcı adı değiştirilirken bir hata meydana geldi!'])
                ->withInput();
        }
    }

    public function changePasswordPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required|min:6',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6'
        ]);
        if ($validator->fails()) {
            return redirect('settings')
                ->withErrors($validator)
                ->withInput();
        }
        $changePassword = users::find($request->currentUser->user_id);
        if($changePassword->user_password ==  md5(md5($request->input('old_password')))){
            $changePassword->user_password = md5(md5($request->input('password')));
            if ($changePassword->save()) {
                return redirect('settings')->with(['message' => 'Şifreniz başarıyla değiştirildi!']);
            } else {
                return redirect('settings')
                    ->withErrors(['Şifre değiştirilirken bir hata meydana geldi!'])
                    ->withInput();
            }
        }else{
            return redirect('settings')
                ->withErrors(['Girmiş olduğunuz eski şifreniz hatalı!'])
                ->withInput();
        }
    }
}
