<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Link;
use Illuminate\Support\Facades\Cookie;
class AdminController extends Controller
{
    public function getUsers(Type $var = null)
    {
        $users = User::All();
        return view("admin.all-users", compact('users', 'users'));
    }
    public function setadmin(Request $r)
    {
        $id = Cookie::get('id');
        $admin = User::get()->where('id' , $id);
        foreach($admin as $a){
            if($a->status == 1){
                $user = User::get()->Where('id',"=", $r->id)->firstOrFail();
 $user->status = "2";  
 $user->save();

            }
        }
        return redirect('admin/users');
    }
    public function getadmins(Type $var = null)
    {
        $users = User::where('status',2)->get();
        return view("admin.admins", compact('users', 'users'));
    }
    public function getLastUsers(Type $var = null)
    {
        $links = Link::paginate(5);
        $users = User::paginate(5);
        return view("admin.dashboard", compact(['users', 'users'],['links', 'links']));
       
    }
    public function editUser(Request $r)
    {
       $user = User::get()->Where('id',$r->id)->firstOrFail();
 $user->name = $r->nameinput;
 $user->email = $r->emailinput; 
 $user->save();

    }
    public function deleteUser(Request $r)
    {
       User::Where('id',$r->id)->delete();
echo $r->id;
    }
    public function countusers()
    {
       echo User::all()->count();
    }
    public function ganalize(Request $r)
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
                
                    setEnv("GOOGLE_ANALIZE",$r->ganalize);
            
                return redirect('admin/dashboard');
            }
        }
        # code...

        
    }
    public function gadsense(Request $r)
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
                
                    setEnv("GOOGLE_ADSENSE",$r->gadsense);
            
                return redirect('admin/dashboard');
            }
        }
        # code...

        
    }
    public function deleteuserfiles(Request $r)
    {
        function setEnv($name, $value)
        {
            $path = base_path('.env');
            if (file_exists($path)) {
                file_put_contents($path, str_replace(
                    $name . '=' . env($name), $name . '=' . $value, file_get_contents($path)
                ));
            }
        }

        if($r->del == 'on'){
            setEnv("DELETE_USER_FILES",true);
        }
        if($r->del == 'off'){
            setEnv("DELETE_USER_FILES",false);
        }
        # code...
        return redirect('admin/dashboard');
    }
}