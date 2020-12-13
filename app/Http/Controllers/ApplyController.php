<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ApplyRequest;
use App\Mail\ApplyMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class ApplyController extends Controller
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
          return view('apply.form_mobile');
        } else {
            return view('apply.form');
        }
    }

    public function confirm(Request $request){
        $user_agent = self::isMobileOrPc($request);

        $contact = $request->all();
        $uploadImg = $request->file('thumbnail');
        $path = Storage::disk('s3')->putFile('circle_apply', $uploadImg, 'public');
        $contact["thumbnail"] = Storage::disk('s3')->url($path);
        $request->session()->regenerateToken();

        if ($user_agent === 'mobile') {
            return view('apply.confirm_mobile',$contact);
        } else {
            return view('apply.confirm',$contact);
        }
    }

    public function sent(Request $request){
        $user_agent = self::isMobileOrPc($request);
      
        $contact = $request->all();
        $contact['thumbnail'] = explode('circle_apply/',$contact["thumbnail"])[1];
        if($request->action === 'back') {
            Storage::disk('s3')->delete('circle_apply/'.$contact['thumbnail']);
            return redirect()->route('apply')->withInput($contact);
        }
        $request->session()->regenerateToken();
        
        Mail::to('shota0215@akane.waseda.jp')->send(new ApplyMail($contact));

        if ($user_agent === 'mobile') {
            return view('apply.thanks_mobile');
        } else {
            return view('apply.thanks');
        }
    }
}
