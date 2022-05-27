<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slide;

class SlidesController extends Controller
{
    public function newslide(Request $request)
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
        $name = createName() . '.'.$request->file('image')->getClientOriginalExtension();
        $request->image->move('slides',$name);
        $save = new Slide;
        $save->image = $name;
        $save->link = $request->link;
        $save->save();
        return redirect('admin/ads');
    }
    public function index()
    {
        $slides = Slide::get();
        
            return view('admin/slides',compact('slides','slides'));
        
    }

    public function deleteslide(Request $r)
    {

        $slide = Slide::find($r->id);
        unlink(PUBLIC_PATH('slides/'.$slide->image));
        $slide->delete();
        return redirect('admin/slides');
    }
}