<?php

use App\Http\Controllers\Api\LinksController;
use Illuminate\Support\Facades\Route;
use App\Mail\Validate;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $slides = DB::table('slides')->get();
    return view('welcome',compact('slides','slides'));
})->name('home');
Route::get('/email', function () {
    return new Validate('{{"hgyhg"}}');
})->name('val');
Route::view('user/sign-up','user/signup')->name('signup');
Route::view('user/log-in','user/login')->name('login');
// Route::view('user/account','user/account')->name('account');
Route::view("features","features")->name('features');
Route::get("my-links",[App\Http\Controllers\LinksController::class, 'getLinks'])->name('my-links');
// Route::get("my-links/link",[App\Http\Controllers\LinksController::class, 'getLink'])->name('my-link');
Route::get('u/{id}', function ($id) {
    
    if(strlen($id) > 5){
        $file_url = asset('up/'.$id);
        header('Content-Type: application/octet-stream');
        header("Content-Transfer-Encoding: Binary"); 
        header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\""); 
        readfile($file_url); 

    }else{
$link = DB::table('links')->where('link', '=', $id)->get();

    return view('link',[
        
        "link" => $link
    ]);
    }
});
Route::group(['prefix' => 'user'], function() {
    Route::get('validate', [App\Http\Controllers\UsersController::class, 'create'])->name('validate');
    Route::get('logInValidate', [App\Http\Controllers\UsersController::class, 'logInVal'])->name('logInValidate');
    Route::get('edituser', [App\Http\Controllers\AdminController::class, 'editUser'])->name('edituser');
    Route::get('logout', [App\Http\Controllers\UsersController::class, 'logOut'])->name('logout');
    Route::get('editpass', [App\Http\Controllers\UsersController::class, 'editPass'])->name('editpass');
    Route::view('reset','user.reset')->name('reset');
    Route::get('account', [App\Http\Controllers\UsersController::class, 'account'])->name('account');
    Route::get('dark', [App\Http\Controllers\UsersController::class, 'setDarkTheme'])->name('dark');
    Route::get('day', [App\Http\Controllers\UsersController::class, 'remDarkTheme'])->name('day');
    Route::get('u-upload', [App\Http\Controllers\UploadsController::class, 'u_uploads'])->name('u-upload');
    
});
Route::group(['prefix' => 'link'], function() {
    Route::post('new', [App\Http\Controllers\LinksController::class, 'create'])->name('new-link');
});
Route::get('deletelink/{id}', [App\Http\Controllers\LinksController::class, 'deletelink']);


Route::get('/{id}/stats', function ($link) {
    $links = DB::table('links')->where('link', '=', $link)->get();
    $day = DB::table('urlvisits')->where('link', '=', $link)->get()->count();
    return view('linkstats',[
        "links" => $links,
        "day" => $day
    ]);
});

Route::group(['prefix' => 'admin'], function() {
    Route::view('login', 'admin/welcome');
    Route::get('users', [App\Http\Controllers\AdminController::class, 'getUsers'])->name('users');
    Route::post('ganalize', [App\Http\Controllers\AdminController::class, 'ganalize'])->name('ganalize');
    Route::post('gadsense', [App\Http\Controllers\AdminController::class, 'gadsense'])->name('gadsense');
    Route::get('admins', [App\Http\Controllers\AdminController::class, 'getadmins'])->name('admins');
    Route::get('setadmin', [App\Http\Controllers\AdminController::class, 'setadmin'])->name('setadmin');
    Route::get('links', [App\Http\Controllers\LinksController::class, 'getAllLinks'])->name('links');
    Route::get('dashboard', [App\Http\Controllers\AdminController::class, 'getLastUsers'])->name('dashboard');
    Route::get('edituser', [App\Http\Controllers\AdminController::class, 'editUser'])->name('edituser');
    Route::get('deleteuser', [App\Http\Controllers\AdminController::class, 'deleteUser'])->name('deleteuser');
    Route::post('deleteuserfiles', [App\Http\Controllers\AdminController::class, 'deleteuserfiles'])->name('deleteuserfiles');
    Route::post('adminlogin', [App\Http\Controllers\UsersController::class, 'adminLogin'])->name('adminlogin');
    
    Route::get('u-upl',[App\Http\Controllers\UploadsController::class, 'getuseruploads'])->name('u-upl');
    Route::get('uploads',[App\Http\Controllers\UploadsController::class, 'uploads'])->name('uploads');
    Route::get('sizeper',[App\Http\Controllers\UploadsController::class, 'sizeper'])->name('sizeper');
    Route::post('upload',[App\Http\Controllers\UploadsController::class, 'upload'])->name('upload');
    Route::post('setsize',[App\Http\Controllers\UploadsController::class, 'setsize'])->name('setsize');
Route::get('slides',[App\Http\Controllers\SlidesController::class, 'index'])->name('slides');
Route::get('deleteslide/{id}',[App\Http\Controllers\SlidesController::class, 'deleteslide'])->name('deleteslide');
    

});
Route::get('countusers',[App\Http\Controllers\AdminController::class, 'countusers'])->name('countusers');

Route::post('send', [App\Http\Controllers\MailController::class, 'sendEmail'])->name('send');

Route::get('reset/{id}', function ($id) {
    $id = $id;
    $data = DB::table('users')->where('reset', '=', $id)->get();
    if($data != "[]"){
        return view('resetpass',[
            'data'=>$data
        ]);
    }else{
        return view('welcome');
    }
   
});

Route::post('changepass', [App\Http\Controllers\UsersController::class, 'changepass'])->name('changepass');


// visits counter
Route::get('day_visits', [App\Http\Controllers\VisitsController::class, 'day_visits']);
Route::get('week_visits', [App\Http\Controllers\VisitsController::class, 'week_visits']);
Route::get('mounth_visits', [App\Http\Controllers\VisitsController::class, 'mounth_visits']);
Route::get('year_visits', [App\Http\Controllers\VisitsController::class, 'year_visits']);
Route::get('custom_visits', [App\Http\Controllers\VisitsController::class, 'custom_visits']);
Route::get('visits', [App\Http\Controllers\VisitsController::class, 'visits']);
Route::get('countmobilevisits', [App\Http\Controllers\VisitsController::class, 'mobilevisits']);
Route::get('countdeskevisits', [App\Http\Controllers\VisitsController::class, 'deskevisits']);


Route::get('countonline', [App\Http\Controllers\UsersController::class, 'countonline']);

Route::get('alllinks', [App\Http\Controllers\LinksController::class, 'getLinksCount']);

Route::get('day_urlvisits', [App\Http\Controllers\UrlVisitsController::class, 'day_urlvisits']);
Route::get('week_urlvisits', [App\Http\Controllers\UrlVisitsController::class, 'week_urlvisits']);
Route::get('mounth_urlvisits', [App\Http\Controllers\UrlVisitsController::class, 'mounth_urlvisits']);
Route::get('year_urlvisits', [App\Http\Controllers\UrlVisitsController::class, 'year_urlvisits']);
Route::get('custom_urlvisits', [App\Http\Controllers\UrlVisitsController::class, 'custom_urlvisits']);
Route::get('urlvisits', [App\Http\Controllers\UrlVisitsController::class, 'urlvisits']);



Route::get('u/{photo}/vi', function ($photo) {
    $photo = $photo;
    $data = DB::table('uploads')->where('file', '=', $photo)->get();
    if($data != "[]"){
        return view('photo',[
            'data'=>$data
        ]);
    }else{
        return view('welcome');
    }
   
});





Route::post('newslide',[App\Http\Controllers\SlidesController::class, 'newslide'])->name('newslide');