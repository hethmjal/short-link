<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Link;
use Illuminate\Support\Facades\Redirect;

class LinksController extends Controller
{
    public function create(Request $r)
    {
        
   //   dd($r->getQueryString());
        $rest = substr($r->link, 8); // returns "d"
        $rest =  $r->link[0] .  $r->link[1] .$r->link[2] .$r->link[3] .$r->link[4] .$r->link[5] .$r->link[6] .$r->link[7] ;  
         
        $rest2 = substr($r->link, 7); // returns "d"
        $rest2 =  $r->link[0] .  $r->link[1] .$r->link[2] .$r->link[3] .$r->link[4] .$r->link[5] .$r->link[6] ;  
        if ($rest == "https://" || $rest2 == "http://") {
          
                $link = Link::where('original_link',$r->link)->first();
                if ($link) {
                    return response()->json([
                        'link'=>'https://localhost:8000/'.$link->link,
                        'status'=>'ok',
                        ]);
                }
            $link = $r->link;
            $pin = $r->pininput;
            $msg = $r->messsageinput;
            $c_link = $r->customlinkinput;
            $userid = 'no';
          
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
                            return response()->json([
                                'link'=>'https://localhost:8000/'.$c_link,
                                'status'=>'ok',
                                ]);
                        }else{
                            
                            
                            return response()->json([
                            'link'=>$link,
                            'status'=>'erorr',
                            ]);
                       
                        }
                    }else{
                        return response()->json([
                            'link'=>$link,
                            'status'=>'erorr',
                            ]);
    
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
                                    return response()->json([
                                        'link'=>'https://localhost:8000/'.$short,
                                        'status'=>'ok',
                                        ]);
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
                           return response()->json([
                                        'link'=>'https://localhost:8000/'.$short,
                                        'status'=>'ok',
                                        ]);
                    }
                    
                }
            }else{
                return response()->json([
                    'link'=>$link,
                    'status'=>'erorr',
                    ]);        }
        }else{
               
            return response()->json([
                'link'=>$r->link,
                'status'=>'erorr',
                ]);
            }
    }
}