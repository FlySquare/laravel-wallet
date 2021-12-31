<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Index extends Controller
{
    public function index(Request $request){
        $data['incomingMoney'] = number_format(array_sum(\App\Models\transactions::where('transaction_ownerid','=',$request->currentUser->user_id)
            ->where('transaction_type','=','add')
            ->pluck('transaction_amount')
            ->toArray()),2);
        $data['outgoingMoney'] = number_format(array_sum(\App\Models\transactions::where('transaction_ownerid','=',$request->currentUser->user_id)
            ->where('transaction_type','=','send')
            ->pluck('transaction_amount')
            ->toArray()),2);
        return view('index')->with('data',$data);
    }
}
