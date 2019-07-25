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

Route::get('forget-password',function(){
   return view('profile.forgetpassword'); 
});

Route::get('/','PostsController@index');
Route::get('/allmessges','MessagessController@index');
Route::get('/getallmessgess','MessagessController@getallmessgess');
Route::get('/getallmessgess/{id}','MessagessController@getallmessgesswithid');
Route::post('/addPost','PostsController@addPost');
Route::get('/allpost','PostsController@allpost');
//Route::get('/getallmessgess',function(){
//        $allUsers=DB::table('users')->where('id','!=', Auth::user()->id)->get();
//        return $allUsers;
//    });

Route::get('/addFriend', function () {
    return Auth::user()->addFreind();
});
Auth::routes();

Route::group(['middleware' => 'auth'], function() {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/profile/{slug}', 'ProfileController@index')->name('profile');
    Route::post('/update_pic', 'ProfileController@pudate_pic')->name('update_pic');
    Route::get('/edit_profile', 'ProfileController@edit_profile')->name('edit_profile');
    Route::post('/updateProfileData', 'ProfileController@updateProfileData')->name('update_profile');
    Route::get('/findfriend', 'ProfileController@findfriend')->name('findfriend');
    Route::get('/addFriend/{id}', 'ProfileController@sendfriendreequest')->name('sendfriendreequest');
    Route::get('/requesters', 'ProfileController@requesters')->name('requesters');
    Route::get('/accept/{name}/{id}', 'ProfileController@accept')->name('accept');
    Route::get('/remove/{name}/{id}', 'ProfileController@remove')->name('remove');
    Route::get('/friends', 'ProfileController@friends')->name('friends');
    Route::get('/unfriend/{name}/{id}', 'ProfileController@unfriend')->name('unfriend');
    Route::get('/notification/{id}', 'ProfileController@notification')->name('notification');
    Route::get('/edit_profile_image', 'ProfileController@edit_profile_image')->name('edit_profile_image');
    Route::post('/sendmessge','MessagessController@storemesge');


});

Route::get('forget-password',function(){

    return view('profile.forgetpassword');
});
Route::post('/settoken','ProfileController@settoken');

Route::get('/settoken/{token}',function($token){
if(isset($token)&& $token!=""){
    $getdata=DB::table('password_resets')->where('token',$token)->get();
    if(count($getdata)!=0){
        return view("profile.passwordresetfrom") ;
    }
}

});

Route::group(['middleware' => 'auth','admin'], function() {

    Route::get('/admin', function(){
        echo "it is admin";
    });
});
Route::group(['middleware' => 'auth','company'], function() {

    Route::get('/company', function(){
        echo "it is company";
    });
});
