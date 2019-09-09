<?php

namespace App\Http\Controllers;

use App\Contact;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    
    public function sendMessage(Request $request)
    {
        //

        $validator=\Validator::make($request->all(),
                    [
            'name'=>'required',
            'email'=>'required|email',
            'subject'=>'required' ,
            'message'=>'required' 
                    ]);


        if ($validator->fails()) {
        return redirect()->route('welcome')
        ->withErrors($validator)
        ->withInput();
        }


        $contact = new Contact();

        $contact->name = $request->name ;
        $contact->email = $request->email ;
        $contact->subject = $request->subject ;
        $contact->message = $request->message ;
        $contact->save();

        Toastr::success('Your Message Successfully Sent !', 'Success', ["positionClass" => "toast-top-center"]);

        return redirect()->back();

    }

    


}
