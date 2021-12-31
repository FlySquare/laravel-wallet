<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class Cards extends Controller
{
    public function myCards()
    {
        return view('cards');
    }

    public function changeCard(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'card_name' => 'required|min:3',
            'card_number' => 'required|min:16',
            'card_expiry' => 'required|min:3',
            'card_ccv' => 'required|min:3'
        ]);
        if ($validator->fails()) {
            return redirect('my-cards')
                ->withErrors($validator)
                ->withInput();
        }
        $card = \App\Models\cards::find($request->input('card_id'));
        if ($card == null) {
            return redirect('my-cards')->withErrors(['message'=>'Adınıza kayıtlı böyle bir kart bulunmamaktadır!']);
        }
        if ($card->card_owner == $request->currentUser->user_id) {
            $card->card_name = $request->input('card_name');
            $card->card_number = $request->input('card_number');
            $card->card_expiry = $request->input('card_expiry');
            $card->card_ccv = $request->input('card_ccv');
            if ($card->save()) {
                return redirect('my-cards')->with(['message' => 'Kartınız başarıyla güncellendi!']);
            } else {
                return redirect('my-cards')->withErrors('Kartınız güncellenirken bir hata meydana geldi!');
            }
        } else {
            return redirect('my-cards')->withErrors('Adınıza kayıtlı böyle bir kart bulunmamaktadır!');
        }
    }

    public function addCard(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'card_name' => 'required|min:3',
            'card_number' => 'required|min:16',
            'card_expiry' => 'required|min:3',
            'card_ccv' => 'required|min:3'
        ]);
        if ($validator->fails()) {
            return redirect('my-cards')
                ->withErrors($validator)
                ->withInput();
        }
        $card = new \App\Models\cards();
            $card->card_name = $request->input('card_name');
            $card->card_number = $request->input('card_number');
            $card->card_expiry = $request->input('card_expiry');
            $card->card_ccv = $request->input('card_ccv');
            $card->card_balance = "000";
            $card->card_owner = $request->currentUser->user_id;
            if ($card->save()) {
                return redirect('my-cards')->with(['message' => 'Kartınız başarıyla tanımlandı!']);
            } else {
                return redirect('my-cards')->withErrors('Kartınız tanımlanırken bir hata meydana geldi!');
            }

    }

    public function deleteCard(Request $request)
    {
        if ($request->id < 1 || !is_numeric($request->id) || !isset($request->id) || empty($request->id)) {
            return redirect('my-cards')
                ->withErrors('Adınıza kayıtlı böyle bir kart bulunmamaktadır!')
                ->withInput();
        }
        $card = \App\Models\cards::find($request->id);
        if ($card == null) {
            return redirect('my-cards')->withErrors('Adınıza kayıtlı böyle bir kart bulunmamaktadır!');
        }
        if ($card->card_owner == $request->currentUser->user_id) {
            if ($card->delete()) {
                return redirect('my-cards')->with(['message' => 'Kartınız başarıyla silindi!']);
            } else {
                return redirect('my-cards')->withErrors('Kartınız silinirken bir hata meydana geldi!');
            }
        } else {
            return redirect('my-cards')->withErrors('Adınıza kayıtlı böyle bir kart bulunmamaktadır!');
        }
    }
}
