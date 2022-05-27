<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visit;
class VisitsController extends Controller
{
    public function day_visits(Request $r)
    {
       $visits = Visit::where("created_at",date("m/d/yy"))->get();
       return $visits->count();
    }
    public function week_visits(Request $r)
    {
        
        $week = Visit::whereBetween('created_at', [$r->from, $r->to])->get()->count();
        $day = Visit::where("created_at",date("m/d/yy"))->get()->count();
        return $day+$week;
    }
    public function mounth_visits(Request $r)
    {
        $m = Visit::whereBetween('created_at', [$r->from, $r->to])->get()->count();
        $day = Visit::where("created_at",date("m/d/yy"))->get()->count();
        return $day+$m;
    }
    public function year_visits(Request $r)
    {
        $y = Visit::whereBetween('created_at', [$r->from, $r->to])->get()->count();
        $day = Visit::where("created_at",date("m/d/yy"))->get()->count();
        return $day+$y;
    }
    public function custom_visits(Request $r)
    {

        $from = substr($r->data, -10);
        $to = substr($r->data, 0 ,10);
        $d = Visit::whereBetween('created_at', [$to, $from])->get()->count();
        $day = Visit::where("created_at",date("m/d/yy"))->get()->count();
        return $d+$day;
    }
    public function visits(Request $r)
    {
        $d = Visit::get();
        return $d->count();
    }
    public function mobilevisits()
    {
        $x = Visit::where("os","=","Android")->get()->count() + Visit::where("os","=","iPhone")->get()->count();
        $y = Visit::all()->count();
        
        $percent = $x/$y;
        echo  number_format( $percent * 100, 2 ) . '%';
       
       
    }
    public function deskevisits()
    {
        $x = Visit::where("os","=","Linux")->get()->count() + Visit::where("os","=","Mac")->get()->count() + Visit::where("os","=","Windows")->get()->count();
        $y = Visit::all()->count();
        
        $percent = $x/$y;
        echo  number_format( $percent * 100, 2 ) . '%';
       
       
    }
}