<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Contacts extends Controller
{
    public function index(){
        return view('contacts');
    }
    public function addContact(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'contact_name' => 'required|min:3',
            'contact_iban' => 'required|min:16'
        ]);
        if ($validator->fails()) {
            return redirect('my-contacts')
                ->withErrors($validator)
                ->withInput();
        }
        $contact = new \App\Models\contacts();
        $contact->contact_name = $request->input('contact_name');
        $contact->contact_iban = $request->input('contact_iban');
        $contact->contact_owner = $request->currentUser->user_id;
        if ($contact->save()) {
            return redirect('my-contacts')->with(['message' => 'Kişiniz başarıyla tanımlandı!']);
        } else {
            return redirect('my-contacts')->withErrors('Kişinizi tanımlanırken bir hata meydana geldi!');
        }

    }
    public function editContact(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'contact_name' => 'required|min:3',
            'contact_iban' => 'required|min:16'
        ]);
        if ($validator->fails()) {
            return redirect('my-contacts')
                ->withErrors($validator)
                ->withInput();
        }
        $contact = \App\Models\contacts::find($request->input('contact_id'));
        $contact->contact_name = $request->input('contact_name');
        $contact->contact_iban = $request->input('contact_iban');
        $contact->contact_owner = $request->currentUser->user_id;
        if ($contact->save()) {
            return redirect('my-contacts')->with(['message' => 'Kişiniz başarıyla güncellendi!']);
        } else {
            return redirect('my-contacts')->withErrors('Kişinizi güncellerken bir hata meydana geldi!');
        }

    }
}
