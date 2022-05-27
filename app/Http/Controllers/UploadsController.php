<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Upload;
use Illuminate\Support\Facades\Cookie;
use App\Models\User;
use App\Models\Slide;

class UploadsController extends Controller
{
    public function uploads()
    {
        $files = Upload::get()->where('user_id',Cookie::get('id'));
		
			return view('admin.uploads',compact('files', 'files'));
		
    }
	public function u_uploads()
	
    {
		function get_client_ip()
        {
            $ipaddress = '';
            if (getenv('HTTP_CLIENT_IP')) {
                $ipaddress = getenv('HTTP_CLIENT_IP');
            } elseif (getenv('HTTP_X_FORWARDED_FOR')) {
                $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
            } elseif (getenv('HTTP_X_FORWARDED')) {
                $ipaddress = getenv('HTTP_X_FORWARDED');
            } elseif (getenv('HTTP_FORWARDED_FOR')) {
                $ipaddress = getenv('HTTP_FORWARDED_FOR');
            } elseif (getenv('HTTP_FORWARDED')) {
                $ipaddress = getenv('HTTP_FORWARDED');
            } elseif (getenv('REMOTE_ADDR')) {
                $ipaddress = getenv('REMOTE_ADDR');
            } else {
                $ipaddress = 'UNKNOWN';
            }
            return $ipaddress;
        }
		
		if(!isset($_cookie['id'])){
			Cookie::queue('ip', get_client_ip()); 
		}
          $files = Upload::get()->whereIn('user_id',[Cookie::get('id'),Cookie::get('ip')]);
	
		return view('uploads',compact('files', 'files'));
    }
   
    public function upload(Request $request)
    {
        
        function createName()
    {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $char = '';
        for ($i = 0; $i < 4; $i++) {
            $char .= $characters[rand(0, strlen($characters))];
        }
        return  $char;
    }
    $size = Upload::get('size');
       $n = 0;
       foreach($size as $s ){
           $n= $n+$s->size;
           
           
        }
           if($n < env("SERVER_SIZE")){
            
            $now = now();
                
                $user = User::find(Cookie::get('id'));
				
				if(!isset($user->status) || empty($user->status)){
					$size = filesize($request->file('file'));
                    if($size <= 5000000000){
                        $name = createName() . '.'.strtolower( $request->file('file')->getClientOriginalExtension()) ;
                        $request->file->move('up',$name);
                        $save = new Upload;
                        $save->file = $name;
                        $save->size = $size;
                        $save->ext =strtolower( $request->file('file')->getClientOriginalExtension()) ;
                        $save->user_id = Cookie::get('ip');
                        $save->status_id = 0;
                        $save->user_name = "ضيف";
                        $save->delete_at = $now->modify('+4 day')->format('Y-m-d');
                        $save->save();
                        return redirect('user/u-upload');
                    }else{
                        $msg = "big file";
                        return redirect('user/u-upload');

                    }
				}
                if($user->status == 0){
                    $size = filesize($request->file('file'));
                    if($size <= 5000000000){
                        $name = createName() . '.'.strtolower( $request->file('file')->getClientOriginalExtension()) ;
                        $request->file->move('up',$name);
                        $save = new Upload;
                        $save->file = $name;
                        $save->size = $size;
                        $save->ext = strtolower( $request->file('file')->getClientOriginalExtension());
                        $save->user_id = $user->id;
                        $save->status_id = $user->status;
                        $save->user_name = $user->name;
                        $save->delete_at = $now->modify('+4 day')->format('Y-m-d');
                        $save->save();
                        return redirect('user/u-upload');
                    }else{
                        $msg = "big file";
                        return redirect('user/u-upload');

                    }
               
               
            
                }else{
                    $size = filesize($request->file('file'));
                    $name = createName() . '.'.strtolower( $request->file('file')->getClientOriginalExtension()) ;
                    $request->file->move('up',$name);
                    $save = new Upload;
                    $save->file = $name;
                    $save->size = $size;
                    $save->ext = strtolower( $request->file('file')->getClientOriginalExtension());
                    $save->user_id = $user->id;
                    $save->status_id = $user->status;
                    $save->user_name = $user->name;

                    $save->delete_at = $now->modify('+1 day')->format('Y-m-d');
                    
                 $save->save();
                 return redirect('admin/uploads');
                }
               
           }
          
           
           
    }
    public function setsize(Request $r)
    {
        $id = Cookie::get('id');
        $admin = User::where('id',$id)->get();
        foreach($admin as $a){
            if($a->status == 1){
                function setEnv($name, $value)
                {
                    $path = base_path('.env');
                    if (file_exists($path)) {
                        file_put_contents($path, str_replace(
                            $name . '=' . env($name), $name . '=' . $value, file_get_contents($path)
                        ));
                    }
                }
                if(is_numeric($r->serversize)){
                    setEnv("SERVER_SIZE",$r->serversize * 1000000000);
                }
                return redirect('admin/dashboard');
            }else{
                echo "j";
            }
        }
        # code...

        
    }
    public function sizeper()
    {
       $size = Upload::get('size');
       $n = 0;
       foreach($size as $s ){
           $n= $n+$s->size;
           
           
        }
        $percent = $n/env('SERVER_SIZE');
        echo number_format( $percent * 100, 2 ) . '%';
        
    }
    public function getuseruploads()
    {
        $up = Upload::get();
        foreach($up as $u){
            $user = User::where('id',$u->user_id)->get();
            return view('admin.useruploads',compact(['up','up',],['user','user']));
        }
        # code...
    }
}