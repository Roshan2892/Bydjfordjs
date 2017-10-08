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

Auth::routes();

/************ Home ***************/
Route::get('/', ['uses'=>'HomeController@index','as'=>'home']);

/************ About **************/
Route::get('/about', function (){
    return view('user.about');
})->name('about');

/************ Contact ************/
Route::get('/contact', ['as'=>'contact.index','uses'=>'ContactController@index']);
Route::post('/contact', ['as'=>'contact.send','uses'=>'ContactController@sendMail']);

/*********** Video ***************/
Route::get('/video/{title}', ['as' => 'video.show', 'uses'=>'VideoController@show']);
Route::get('/video', ['as' => 'video.index', 'uses'=>'VideoController@index']);

/*********** Music ***************/
Route::get('/music/singles', ['as' => 'singles.index', 'uses'=>'MusicController@showSingles']);
Route::get('/music/albums', ['as' => 'albums.index', 'uses'=>'MusicController@showAlbum']);
Route::get('/music/{title}', ['as' => 'music.show', 'uses'=>'MusicController@show']);
Route::get('/music/download/{file}',[ 'as' => 'music.download', 'uses'=>'MusicController@download' ]);

/********** Podcast **************/
Route::get('/podcast/{title}', ['as' => 'podcast.show', 'uses'=>'PodcastController@show']);
Route::get('/podcast', ['as' => 'podcast.index', 'uses'=>'PodcastController@index']);
Route::get('/podcast/download/{id}',['as' =>'podcast.download', 'uses'=>'PodcastController@download']);

/********** News ******************/
Route::get('/news/{title}', ['as' => 'news.show', 'uses'=>'NewsController@show']);
Route::get('/news', ['as' => 'news.index', 'uses'=>'NewsController@index']);

/********** Mails *****************/
Route::post('/subscribe', ['as' => 'subscribe', 'uses' => 'MailController@subscribe']);
Route::get('/subscribe/{hash}', [ 'uses'=>'MailController@confirmSubscriptions', 'as'=>'confirm.subscription' ]);
Route::get('/unsubscribe/{hash}',['uses'=>'MailController@unsubscribe', 'as'=>'unsubscribe']);

/********** Search *****************/
Route::get('/search', ['as' => 'search', 'uses' => 'HomeController@search_page']);
Route::post('/search', ['as' => 'search', 'uses' => 'HomeController@search']);

/********** Admin *****************/
Route::group(['prefix'=>'admin'], function (){
	Route::get('/', 'AdminController@index')->name('admin.dashboard');
	Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
	Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);

	Route::get('/music/',['as'=>'admin.music.show','uses'=>'MusicController@showAlbums']);
    Route::get('/music/delete/{id}/{filename}',['as'=>'admin.music.delete','uses'=>'MusicController@deleteMusic']);
    Route::resource('music', 'MusicController',[
        'except' => [
            'index', 'show'
        ]
    ]);
    Route::get('/video/',['as'=>'admin.video.show','uses'=>'VideoController@showVideos']);
    Route::resource('video', 'VideoController',[
        'except' => [
            'index', 'show'
        ]
    ]);
    Route::get('/podcast/',['as'=>'admin.podcast.show','uses'=>'PodcastController@showPodcasts']);
    Route::get('/podcast/delete/{id}/{filename}',['as'=>'admin.podcast.delete','uses'=>'PodcastController@deletePodcast']);
    Route::resource('podcast', 'PodcastController',[
        'except' => [
            'index', 'show'
        ]
    ]);
    Route::get('/news/',['as'=>'admin.news.show','uses'=>'NewsController@showNews']);
    Route::resource('news', 'NewsController',[
        'except' => [
            'index', 'show'
        ]
    ]);

    Route::get('/mail', [ 'as' => 'admin.email.show_form', 'uses' => 'MailController@showMailForm' ]);
    Route::post('/mail', [ 'as' => 'admin.email.send', 'uses' => 'MailController@sendBulkMails' ]);
    /*Route::get('/admin/media', 'FileController@show');
    Route::get('/admin/albums/delete/{id}', ['as' =>'delete', 'uses' => 'FileController@destroy']);*/
});




