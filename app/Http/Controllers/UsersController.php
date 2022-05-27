<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redirect;
use Crypt;

class UsersController extends Controller
{
    //
    public function index ()
    {
        return view('user.signup');
    }
    public function login ()
    {
        return view('user.login');
    }
    public function create (Request $r)
    {
        $name = $r->nameinput;
        $email = $r->emailinput;
        $pass = md5($r->passwordinput);
        $pass2 = $r->password2input;

        $data = User::get()->where('email', '=', $email);
        if($data == '[]'){
            User::create([
                'name'=>$name,
                'email'=>$email,
                'password'=>$pass,
            ]);
            return "success";
        }else{
            return '
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-check"></i> تنبيه !</h5>
                   البريد الالكتروني مستخدم.
                    </div>';
        }
        
       
    }
    
    public function logInVal(Request $r)
    {
        $email = $r->emailinput;
        $pass = md5($r->passwordinput);
       

        $data = User::get()->where('email', '=', $email);
        foreach($data as $d){
            if($d->email){
                if($pass === $d->password){
                 
                    Cookie::queue('id', $d->id, 360000); 
                   
				  return "success";
                }else{
                    return '
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-check"></i> تنبيه !</h5>
                        البريد الالكتروني او كلمة المرور غير صحيحة.
                    </div>';
                }
            }
        }
        if($data == "[]"){
            return '
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> تنبيه !</h5>
                البريد الالكتروني او كلمة المرور غير صحيحة.
            </div>';
        }
        
    }
    public function logOut()
    {
        
        Cookie::queue(Cookie::forget('id')); 
		return redirect()->route('home');
    }
    public function setDarkTheme()
    {
        Cookie::queue('dark', "dark", 360000);
        return Redirect::back();
    }
    public function remDarkTheme()
    {
        Cookie::queue(Cookie::forget('dark')); 
        return Redirect::back();
    }
    public function account()
    {
        $id = Cookie::get('id');
        $data = User::get()->where('id', '=', $id);
        return view('user.account', compact($data , 'data'));
    }

    public function adminLogin(Request $r)
    {
        $email = $r->emailinput;
        $pass = $r->passwordinput;
      

        $data = User::get()->where('email', '=', $email);
        foreach($data as $d){
            if($d->email){
                if(md5($pass) === $d->password ){
                    
                    if($d->status == 2 || $d->status == 1 ){
                        
                        Cookie::queue('id', $d->id , 36000);
                        Cookie::queue('admin', "admin");
                        return Redirect()->route('dashboard');
                    }
				   return "no";
            }else{
                return "false";
            }
        }
        
    }
}

public function editPass(Request $r)
    {
        $data = User::where("id",$r->id)->get();
        
foreach ($data as $d){
    if(md5($r->oldpass) == $d->password){
        if($r->newpass == $r->newpass2){
            $user = User::get()->Where('id',$r->id)->firstOrFail();
 $user->password = md5($r->newpass); 
 $user->save();
        }
    }
   
}

    }


    public function changepass(Request $r)
    {
        $data = User::where("id",$r->id)->get();
        if($r->newpass == $r->newpass2){
            $user = User::get()->Where('id',$r->id)->firstOrFail();
 $user->password = md5($r->newpass); 
 $user->reset = (''); 
 $user->save();
        }


    }
    // public function reset()
    // {
    //     $data = User::get()->Where('email',$r->emailinput);
        
    // }

    public function countonline()
    {
        $now = date("m/d/Y h:i");
        return User::get()->Where('active',$now)->count();
    }
    
}