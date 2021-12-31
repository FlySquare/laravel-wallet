<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Transactions extends Controller
{
    public function index(Request $request)
    {
        $data['mysql_transactions'] = \App\Models\transactions::where('transaction_ownerid', '=', $request->currentUser->user_id)
           ->orderBy('transaction_date','DESC')
            ->get();
        $data['transactions'] = [];
        foreach ($data['mysql_transactions'] as $key => $transaction) {
            if (explode(' ', $transaction->transaction_date)[0] == Carbon::today()->format('Y-m-d')) {
                $data['transactions']['BB'][] = $data['mysql_transactions'][$key];
            } elseif (explode(' ', $transaction->transaction_date)[0] == Carbon::yesterday()->format('Y-m-d')) {
                $data['transactions']['AA'][] = $data['mysql_transactions'][$key];
            } else {
                $data['transactions'][explode(' ', $transaction->transaction_date)[0]][] = $data['mysql_transactions'][$key];
            }
        }
        krsort($data['transactions'], 0);
        return view('transactions')->with('data',$data);
    }

    public function sendMoney(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'account' => 'required|min:1|numeric',
            'desc' => 'required',
            'amount' => 'required|min:1|numeric'
        ]);
        if ($validator->fails()) {
            return redirect('/')
                ->withErrors($validator)
                ->withInput();
        }
        $card = \App\Models\cards::find($request->input('account'));
        if ($card->card_balance > $request->input('amount')) {
            $transaction = new \App\Models\transactions();
            $transaction->transaction_ownerid = $request->currentUser->user_id;
            $transaction->transaction_cardid = $request->input('account');
            $transaction->transaction_desc = $request->input('desc');
            $transaction->transaction_amount = $request->input('amount');
            $transaction->transaction_type = "send";
            if ($transaction->save()) {

                $card->card_balance -= $request->input('amount');
                if ($card->save()) {
                    return redirect('/')->with(['message' => 'Bakiye başarıyla çıkartıldı!']);
                } else {
                    return redirect('/')->withErrors('Bakiye çıkartıldı ancak kart bakiyenizden düşülürken bir hata meydana geldi!');
                }
            } else {
                return redirect('/')->withErrors('Bakiye çıkartılırken bir hata meydana geldi!');
            }
        } else {
            return redirect('/')->withErrors('Bu hesabınızın bakiyesi yeterli değil!');
        }
    }

    public function addMoney(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'account' => 'required|min:1|numeric',
            'desc' => 'required',
            'amount' => 'required|min:1|numeric'
        ]);
        if ($validator->fails()) {
            return redirect('/')
                ->withErrors($validator)
                ->withInput();
        }
        $transaction = new \App\Models\transactions();
        $transaction->transaction_ownerid = $request->currentUser->user_id;
        $transaction->transaction_cardid = $request->input('account');
        $transaction->transaction_desc = $request->input('desc');
        $transaction->transaction_amount = $request->input('amount');
        $transaction->transaction_type = "add";
        if ($transaction->save()) {
            $card = \App\Models\cards::find($request->input('account'));
            $card->card_balance += $request->input('amount');
            if ($card->save()) {
                return redirect('/')->with(['message' => 'Bakiye başarıyla eklendi!']);
            } else {
                return redirect('/')->withErrors('Bakiye eklendi ancak kart bakiyenize eklenirken bir hata meydana geldi!');
            }
        } else {
            return redirect('/')->withErrors('Bakiye eklenirken bir hata meydana geldi!');
        }
    }
}
