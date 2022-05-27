<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewMail;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;

class MailController extends Controller
{
    public function sendEmail(Request $r)
    {
        
        
        $data = User::get()->Where('email',$r->emailinput);
        if($data != "[]"){
            $user = User::get()->Where('email',$r->emailinput)->firstOrFail();
            $link = Crypt::encrypt($r->emailinput);
            $user->reset = $link; 
            $user->save();
            $content = [
                'title'=>"استعادة كلمة المرور",
                'body'=>"اضغط على هذا الرابط لتغيير كلمة المرور",
                "link"=>'https://laravel.athootech.sd/reset/'.$link
            ];
            Mail::to($r->emailinput)->send(new NewMail($content)); 
          }
          ?>
<meta http-equiv="refresh" content="0; url=../">
<?php
}

}