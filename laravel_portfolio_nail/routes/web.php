<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;

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


//fullcalendar ==========================================================
Route::prefix('mypage')
    ->namespace('MyPage')
    ->middleware(['auth', 'language'])
    ->group(function () {
        Route::resource('/fullcalendar', FullCalendarController::class);
    });


//fullcalendar end ==========================================================


//portfolio ==========================================================
Route::middleware('language')
    ->get('/', 'PortfolioController@index')->name('portfolio.index');
//portfolio end ==========================================================

//main ==========================================================
Route::middleware('language')
    ->get('/main', 'MainController@index')->name('main.index');
//main end ==========================================================

//lang ==========================================================
Route::get('/lang/{lang}', function ($lang) {
    if (!in_array($lang, ['ko', 'ja'])) {
        $lang = 'ko';
    }

    session()->put('locale', $lang);
    return redirect()->back();
})->name('lang.index');
//lang end ==========================================================

//MyPage ==========================================================
Route::prefix('mypage')
    ->namespace('MyPage')
    ->middleware(['auth', 'language'])
    ->group(function () {
        Route::resource('profile', ProfileController::class)
            ->only(['index', 'store']);

        Route::resource('bought', BoughtController::class)
            ->only(['index']);

        Route::resource('fullOrder', FullOrderController::class)
            ->only(['index', 'store', 'update']);

        Route::resource('cart', CartController::class)
            ->only(['index', 'update', 'destroy']);
    });
//MyPage end ==========================================================

//order ==========================================================
Route::middleware(['auth', 'language'])
    ->namespace('Order')
    ->group(function () {
        Route::resource('order', OrderController::class)
            ->only(['index', 'show', 'update', 'store']);
    });
//order end ==========================================================

//Gallery ==========================================================
Route::middleware(['auth', 'language'])
    ->namespace('Gallery')
    ->group(function () {
        Route::resource('gallery', GalleryController::class);
    });

Route::middleware('language')
    ->get('/gallery', 'Gallery\GalleryController@index')->name('gallery.index');
Route::middleware('language')
    ->get('/gallery/{gallery}', 'Gallery\GalleryController@show')->name('gallery.show');
//Gallery end ==========================================================

//Item ==========================================================
Route::middleware(['auth', 'language'])
    ->namespace('Item')
    ->group(function () {
        Route::resource('item', ItemController::class)
            ->only(['create', 'show', 'store', 'destroy']);
    });

Route::middleware('language')
    ->get('/item', 'Item\ItemController@index')->name('item.index');
Route::middleware('language')
    ->get('/item/{item}', 'Item\ItemController@show')->name('item.show');
//Item end ==========================================================

//Q&A ==========================================================
Route::middleware(['auth', 'inquiry', 'language'])
    ->namespace('Inquiry')
    ->group(function () {
        Route::resource('qna', InquiryController::class);
    });

Route::middleware('language')
    ->get('/qna', 'Inquiry\InquiryController@index')->name('qna.index');

////Q&A secret ===============================================
Route::prefix('qna/{qna}')
    ->middleware(['auth', 'language'])
    ->namespace('Inquiry')
    ->group(function () {
        Route::resource('secret', SecretController::class)
            ->only(['index', 'store']);
    });
////Q&A secret end============================================

////Q&A comment ==============================================
Route::prefix('qna/{qna}')
    ->middleware(['auth', 'language'])
    ->group(function () {
        Route::resource('comment', Inquiry\CommentController::class);
    });
////Q&A comment end===========================================

//Q&A end==========================================================
