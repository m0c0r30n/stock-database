<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Contact;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;


class ContactController extends Controller
{  
    /**
    * クライアントの使用端末がMobileかPCか判定
    *
    * @param $request
    * @return string
    * @access private
    */
   private static function isMobileOrPc($request): string
   {
       $user_agent =  $request->header('User-Agent');
       if ((strpos($user_agent, 'iPhone') !== false)
           || (strpos($user_agent, 'iPod') !== false)
           || (strpos($user_agent, 'Android') !== false)) {
           return 'mobile';
       } else {
           return 'pc';
       }
   }
    public function index(Request $request){
        $user_agent = self::isMobileOrPc($request);
  
        if ($user_agent === 'mobile') {
          return view('contact.form_mobile');
        } else {
            return view('contact.form');
        }
    }

    public function confirm(Request $request){
        $user_agent = self::isMobileOrPc($request);
  
        $contact = $request->all();
        $request->session()->regenerateToken();

        if ($user_agent === 'mobile') {
            return view('contact.confirm_mobile',$contact);
        } else {
            return view('contact.confirm',$contact);
        }
    }

    public function sent(Request $request){
        $user_agent = self::isMobileOrPc($request);
  
        $contact = $request->all();
        if($request->action === 'back') {
            return redirect()->route('contact')->withInput($contact);
        }

        $request->session()->regenerateToken();
        
        Mail::to('shota0215@akane.waseda.jp')->send(new ContactMail($contact));

        if ($user_agent === 'mobile') {
            return view('contact.thanks_mobile');
        } else {
            return view('contact.thanks');
        }
    }
}
