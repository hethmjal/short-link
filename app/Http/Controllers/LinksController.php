<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Link;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redirect;


class LinksController extends Controller
{
    public function getLinks()
    {
        $id = Cookie::get('id');
        $links = Link::get()->where('user_id', "=" , $id);
        
        return view('my-links',compact('links','links'));
    }
    public function getAllLinks()
    {
       
        $links = Link::get();
        // return $links;
        return view('admin.all-links',compact('links','links'));
    }
    public function getLinksCount()
    {
       
        $links = Link::All()->count();
        // return $links;
        return $links;
    }
    public function getLink()
    {
        return view('linkstats');
    }


    public function create(Request $r)
    {
        $link = $r->linkinput;
        $pin = $r->pininput;
        $msg = $r->messsageinput;
        $c_link = $r->customlinkinput;
        $userid = 'no';
        if(isset($_COOKIE['id'])){
            $userid = Cookie::get('id');
        }
        function createLink(){ $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';$char = '';for ($i = 0; $i < 4; $i++) {$char .= $characters[rand(0, strlen($characters))];} return  $char;}

        if(!empty($link)){
            if(!empty($c_link)){
                if(strlen($c_link) == 4){
                    $links = Link::where("link",$c_link)->count();
                    if($links <= 0){
                        $newlink = new Link;
                        $newlink->original_link = $link;
                        $newlink->link = $c_link;
                        $newlink->user_id = $userid;
                        $newlink->link_pin = $pin;
                        $newlink->custom_msg = $msg;
                        $newlink->save();
                        return redirect('/'.$c_link.'/stats');
                    }else{
                        return Redirect::back()->withErrors(["msg"=>"هذه اللاحقة مستخدمة من قبل"]);
                    }
                }else{
                    return Redirect::back()->withErrors(["msg"=>"يجب ان تتكون اللاحقة من اربع احرف"]);

                }
            }
            

            if(empty($c_link)){
                $short = createLink();
                $links = Link::get()->where("link",'=',$short);
                if($links->count() > 0){
                    foreach($links as $l ){
                        for($i = 1; $i < 6;$i++){
                            $short = createLink();
                            if($l->link != $short){
                                $newlink = new Link;
                                $newlink->original_link = $link;
                                $newlink->link = $short;
                                $newlink->user_id = $userid;
                                $newlink->link_pin = $pin;
                                $newlink->custom_msg = $msg;
                                $newlink->save();
                                return redirect('/'.$short.'/stats');
                            }
                        }
                    }
                }else{
                    $newlink = new Link;
                    $newlink->original_link = $link;
                    $newlink->link = $short;
                    $newlink->user_id = $userid;
                    $newlink->link_pin = $pin;
                    $newlink->custom_msg = $msg;
                    $newlink->save();
                    return redirect('/'.$short.'/stats');
                }
                
            }
        }else{
            return Redirect::back()->withErrors(["msg"=>"يجب ان لا يكون حقل الرابط فارغا"]);
        }

    }
    
    public function deletelink(Request $r)
    {
        $link = Link::find($r->id);
        $userid = Cookie::get('id');
        if($link->id == $userid || $link->id == 'no' || $userid == 1){
            $link->delete();
        }
        return Redirect::back();
    }
}