<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contai ns the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



// Route::get('/rooms', 'HomeController@rooms')->name('rooms');
Route::get('/services', 'HomeController@services')->name('services');
Route::get('/contact', 'HomeController@contact')->name('contact');
Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/rooms', function () {
    $data=   DB::table('rooms')
        ->select('rooms.roomID','rooms.size','rooms.description','rooms.price','rooms.Bed_Type','rooms.Facilities','rooms.room_image')
        ->get();

       return view('rooms')->with('rooms',$data);
});

Route::get('/bookThisRoom', 'BookingController@bookThisRoom');


Route::get('/showAdminPanel', function(){
        return view('waitinglist');
});

Route::get('/profile', 'UserController@profile');
Route::post('/profile','UserController@update_profile1');

Route::get('/editprofile{id}','UserController@edit');
Route::put('/update{id}','UserController@update');
Route::get('/waitinglist','front@managewaiting');



Route::get('/waitinglist','front@managewaiting');
Route::get('/confirm', function () {
    return view('confirmreq');
});

//Route::get('/confirm/{Empno}','front@doconfirm');



Route::get('/douserconfirm/{Empno}','front@douserconfirm');
Route::get('/rejectuser/{Empno}','front@rejectuser');
//Route::post('/payinfo','front@payment');

Route::get('/paymentinfo','front@paymentinfo');
//Route::get('/paybillinfo/{Empno}','front@paybillinfo');
Route::post('/dopay','front@dopay');

 //Admin Panel Routes
 Route::get('/adminIndex', function () {
    return view('adminIndex');
});

Route::get('/managerooms', function () {
    return view('manageroom');
});

Route::post('/addRoom','front@addRoom');

//update room
Route::get('/updateroom','front@updateroom');
Route::post('/updateroom','front@updateroomvalue');

//delete room
Route::get('/deleteroom','front@deleteroom');
Route::post('/deleteroom','front@deleteroomdetails');

Route::get('/confirmuser','front@confirmuser');

Route::get('/confirmlist','front@confirmrequest');
Route::get('/confirm/{Empno}/{Roomid}/{Strd}/{Endd}', 'front@doconfirm');
Route::get('/reject/{Empno}/{Roomid}/{Strd}/{Endd}', 'front@doreject');



//check available
Route::post('/date','check_available_room_contoller@checkdate');
Route::get('/availableroom','check_available_room_contoller@checkdate');





//Booking
Route::get('/bookthis','front@bookThis');

//mail send to user confirm AR
//Route::post('/conforimreq','MailController@send');
Route::get('/send','MailController@send');
//change
Route::post('/ChangePassword/{id}','AccountSetting@ChangePassword');
Route::get('/pdf','PDFController@pdf');

Route::get('/resetpass', function () {
    return view('/resetpass');
});

//Download pdf  user
//Route::get('/pdf/pdf','PDFController@pdf');// Route::get('/pdf/pdf','PDFController@pdf');

    
Route::get('/mypdf','front@mypdf');

Route::get('/downloadpdf/{Empno}/{Roomid}/{Strd}/{Endd}', 'PDFController@pdf');


// manage user

Route::get('/userdetails','front@userdetails');
Route::get('/removeuser/{Empno}','front@removeuser');
Route::get('/setadmin/{Empno}','front@setadmin');

Route::get('/summary','front@summary');

