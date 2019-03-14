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
Route::get('mylogin',function(){
    return view('mylogin');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
