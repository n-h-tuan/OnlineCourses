<?php

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
Auth::routes(['verify' => true]);

Route::get('/', function () {
    return view('welcome');
});
Route::get('test',function(){
    $day=5;
    $myStringDate = date('d-m-Y H:i:s'); // return về string
    $stringDate = "13-03-2019 09:45:10";
    if(($myStringDate) > ($stringDate))
        echo "true";
    else
        echo "false";
    // $mydate = new DateTime();
    $datesum = date('d-m-Y H:i:s',strtotime($myStringDate.' + '.$day.' months')); 
    //Thay "Hours" thành "days || months || ...." thêm "s" phía cuối => dùng thằng nào thì sẽ cộng vào thằng đó
    // return $datesum;
    // return $myStringDate;
});
Route::get('test01',function(){
    $day= strtotime('2019-03-05T17:00:00.000000Z');
    // $mnd = DateTime::createFromFormat('Y-m-d',$day)->format('d-m-Y');
    $newFormat = date('d-m-Y H:i:s',$day);
    return $newFormat;
});

Route::get('randomString',function(){
    for ($i=0; $i < 10; $i++) { 
        echo "=============================================== </br>";
        // $md5 =MD5(microtime()); 
        // echo $md5."<br/>";
        // $str_shuffle = str_shuffle($md5);
        // echo $str_shuffle."<br/>";
        // echo substr($str_shuffle,0,10)."<br/>";
        echo substr(str_shuffle(md5(microtime())),0,10)."<br/>";
        // echo "=============================================== </br>";
    }
});
Route::get('Count','NganLuongController@KiemTraCodeKhoaHocItHon2');
Route::get('TestAddCode','NganLuongController@testting');

Route::get('import',function(){
    return view('import');
});

Route::get('mylogin',function(){
    return view('mylogin');
    
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('test2', function(){
    $str = "https://res.cloudinary.com/tuannguyen/image/upload/c_fit,h_150,w_340/v1/user/jkixat0bmbc5drv6syuu.jpg";
    $viTriC_fit = strpos($str, "c_fit" );
    $str1 = substr($str,0,$viTriC_fit); // Cắt tới chữ upload/
    $viTriv1 = strpos($str,"v1/user");
    $str2 = substr($str,$viTriv1);

    $finalString = $str1.$str2;
    return $finalString;
});

Route::get('send/email','MailController@Code');

// Route::get('auth/{provider}', 'Auth\LoginController@redirectToProvider')->name('google.login');
// Route::get('auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('auth/{provider}', 'LoginController@redirectToProvider')->name('google.login');
Route::get('auth/{provider}/callback', 'LoginController@handleProviderCallback');

Route::get('payment_recall',function(){
    return view('payment');
})->name('payment.recall');