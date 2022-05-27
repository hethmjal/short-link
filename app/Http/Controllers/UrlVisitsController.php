<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Url;
class UrlVisitsController extends Controller
{
    public function day_urlvisits(Request $r)
    {
       $urlvisits = Url::where("created_at",date("m/d/Y"))->get();
       return $urlvisits->count();
    }
    public function week_urlvisits(Request $r)
    {
        
        $week = Url::whereBetween('created_at', [$r->from, $r->to])->get()->count();
        $day = Url::where("created_at",date("m/d/Y"))->get()->count();
        return $day+$week;
    }
    public function mounth_urlvisits(Request $r)
    {
        $m = Url::whereBetween('created_at', [$r->from, $r->to])->get()->count();
        $day = Url::where("created_at",date("m/d/Y"))->get()->count();
        return $day+$m;
    }
    public function year_urlvisits(Request $r)
    {
        $y = Url::whereBetween('created_at', [$r->from, $r->to])->get()->count();
        $day = Url::where("created_at",date("m/d/Y"))->get()->count();
        return $day+$y;
    }
    public function custom_urlvisits(Request $r)
    {

        $from = substr($r->data, -10);
        $to = substr($r->data, 0 ,10);
        $d = Url::whereBetween('created_at', [$to, $from])->get()->count();
        $day = Url::where("created_at",date("m/d/Y"))->get()->count();
        return $d+$day;
    }
    public function urlvisits(Request $r)
    {
        $d = Url::get();
        return $d->count();
    }
}