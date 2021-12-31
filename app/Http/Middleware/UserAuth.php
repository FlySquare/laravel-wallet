<?php

namespace App\Http\Middleware;

use App\Models\users;
use Closure;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class UserAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $disabledPages = array(
          'login',
          'loginPost',
          'register',
          'registerPost'
        );
        if(!in_array($request->path(),$disabledPages)){
            if(!$request->session()->has('user_id')){
                Session::flush();
                return redirect(route('login'));
            }else{
                $user = users::where('user_id', '=', Crypt::decryptString($request->session()->get('user_id')))
                    ->first();
                if($user == null){
                    Session::flush();
                    return redirect(route('login'));
                }else{
                    $request['currentUser'] = $user;
                    $request['totalBalance'] = number_format(array_sum(\App\Models\cards::where('card_owner','=',$request->currentUser->user_id)
                        ->pluck('card_balance')
                        ->toArray()),2);
                    return $next($request);
                }
            }
        }else{
            if($request->session()->has('user_id')){
                return redirect(route('index'));
            }else{
                return $next($request);
            }
        }
    }
}
