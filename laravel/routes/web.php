<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\Authentication;
use App\Http\Controllers\Gamesetting;
use App\Http\Controllers\Pages;
use App\Http\Controllers\Userdetail;
use App\Http\Controllers\Adminapi;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\AdsController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ColorPrediction;
use Illuminate\Support\Facades\Route;

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
Route::get('/storagelink', function () {
	$target = '/home/u558340823/domains/thixpro.in/public_html/aviator/laravel/storage/app/public/';
   $shortcut = '/home/u558340823/domains/thixpro.in/public_html/aviator/storage/';
   symlink($target, $shortcut);
    dd('storage link successfully');
});
Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('route:clear');
    Artisan::call('optimize');
    dd('Cache cleared successfully');
});
Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('welcome');
});
Route::get('/register', function () {
    return view('register');
});
// Auth Login
Route::post('/auth/login', [Authentication::class, "login"]);
Route::post('/auth/register', [Authentication::class, "register"]);
Route::get('/is_login', [Userdetail::class, "is_login"]);
Route::get('/game-cron', [Gamesetting::class, "cronjob"]);

    // Route::get('/', [TicketController::class, "supportTicket"]);
    Route::get('new-ticket', [TicketController::class, "openSupportTicket"]);
    Route::post('create-ticket', [TicketController::class, "storeSupportTicket"]);
    Route::get('user-all-tickets', [TicketController::class, "viewAllTickets"]);
    Route::post('reply/ticket', [TicketController::class, "replyTicket"]);
    // Route::get('view/{ticket}', [TicketController::class, "viewTicket"]);
    
    // Route::post('close/{ticket}', [TicketController::class, "closeTicket"]);
    // Route::get('download/{ticket}', [TicketController::class, "ticketDownload"]);

// Auth Admin Login
Route::post('/auth/admin/login', [Authentication::class, "adminlogin"]);

// Admin Login
Route::get('/admin', [Admin::class, "login"]);
Route::group(['prefix' => 'admin/', 'middleware' => ['isAdmin']], function () {
    Route::get('/dashboard', [Admin::class, "dashboard"]);
    Route::get('/user-all', [Admin::class, "userAll"]);
    Route::get('/user-active', [Admin::class, "active"]);
    Route::get('/user-deactive', [Admin::class, "deactive"]);
    Route::get('/user-today', [Admin::class, "userToday"]);
    Route::get('/change-password', [Admin::class, "chagepassword"]);
    Route::get('/user/edit/{id}', [Admin::class, "useredit"]);
    
    Route::get('/deposit-pending', [Admin::class, "depositPending"]);
    Route::get('/deposit-apporved', [Admin::class, "depositApporved"]);
    Route::get('/deposit-rejected', [Admin::class, "depositRejected"]);
    Route::get('/deposit-today', [Admin::class, "depositToday"]);
    
    Route::get('/withdrawal-pending', [Admin::class, "withdrawalPending"]);
    Route::get('/withdrawal-apporved', [Admin::class, "withdrawalApporved"]);
    Route::get('/withdrawal-rejected', [Admin::class, "withdrawalRejected"]);
    Route::get('/withdrawal-today', [Admin::class, "withdrawalToday"]);
    
    Route::get('/bet-total', [Admin::class, "betTotal"]);
    Route::get('/win-total', [Admin::class, "winTotal"]);
    Route::get('/loss-total', [Admin::class, "lossTotal"]);
    
    Route::get('/bet-today', [Admin::class, "betToday"]);
    Route::get('/win-today', [Admin::class, "winToday"]);
    Route::get('/loss-today', [Admin::class, "lossToday"]);
    
    Route::get('/amount-setup/{id?}', [Admin::class, "amountsetup"]);
    Route::get('/bank-detail', [Admin::class, "bankdetail"]);
    Route::get('/adcostsetup', [AdsController::class, "adCostSetup"]);
    Route::get('/uploadad', [Adminapi::class, "showUploadAd"]);
    Route::get('/ads-pending', [Adminapi::class, "showPendingAds"]);
    Route::get('/ads-approved', [Adminapi::class, "showApprovedAds"]);
    Route::get('/ads-rejected', [Adminapi::class, "showRejectedAds"]);
    Route::get('/all-tickets', [Admin::class, "showAllTickets"]);
    Route::get('/open-tickets', [Admin::class, "showOpenTickets"]);
    Route::get('/closed-tickets', [Admin::class, "showClosedTickets"]);
    Route::post('reply/ticket', [Adminapi::class, "replyTicket"]);
    Route::post('close/ticket', [Adminapi::class, "closeTicket"]);
    
    
    Route::group(['prefix' => 'api/'], function () {
        Route::post('/changepassword', [Adminapi::class, "changepassword"]);
        Route::post('/edituser', [Adminapi::class, "edituser"]);
        Route::post('/recharge/{event}', [Adminapi::class, "rechargeapproval"]);
        Route::post('/withdraw/{event}', [Adminapi::class, "withdrawalapproval"]);
        Route::post('/user/delete', [Adminapi::class, "userdelete"]);
        Route::post('/editamountsetup', [Adminapi::class, "editamountsetup"]);
        Route::post('/bankdetail', [Adminapi::class, "editbankdetail"]);
        Route::post('/updatewallet', [Adminapi::class, "updatewallet"]);
        Route::post('/adcostsetup', [AdsController::class, "createAdPackage"]);
        Route::post('/uploadad', [Adminapi::class, "uploaNewdAd"]);
        Route::post('/ad/{event}', [Adminapi::class, "adEvent"]);
        Route::post('/ticket-reply', [Adminapi::class, "uploaNewdAd"]);
    });

    Route::get('/logout', [Admin::class, "logout"]);
});

Route::group(['middleware' => ['isUser']], function () {

    Route::get('/profile', [Userdetail::class, "profile"]);
    Route::get('/crash', [Pages::class, "aviator"]);
    Route::get('/deposit', [Pages::class, 'deposit']);
    Route::get('/withdraw', [Pages::class, 'withdrawal']);
    Route::get('/create', [Pages::class, 'create']);
    Route::get('/amount-transfer', [Pages::class, "amount_transfer"]);
    Route::get('/withdraw1', function () {
        return view('withdraw1');
    });
    Route::get('/referal', function () {
        return view('refferal');
    });
    Route::get('/level-management', [Pages::class,'level_management']);

    Route::get('/deposit_withdrawals', [Userdetail::class, "deposit_withdrawal"]);
    Route::get('/logout', function () {
        if (session()->has('userlogin')) {
            session()->forget('userlogin');
        }
        return redirect('/');
    });
    //Api
    Route::get('/get_user_details', [Userdetail::class, "get_user_detail"]);
    // Api Lists App Createion

    //Data api
    Route::post('/user/withdrawal_list', [Userdetail::class, "withdrawal_list"]);
    Route::post('/game/existence', [Gamesetting::class, "game_existence"]);
    Route::post('/game/crash_plane', [Gamesetting::class, "crash_plane"]);
    Route::post('/game/new_game_generated', [Gamesetting::class, "new_game_generated"]);
    Route::post('/game/increamentor', [Gamesetting::class, "increamentor"]);
    Route::post('/game/game_over', [Gamesetting::class, "game_over"]);
    Route::post('/game/add_bet', [Gamesetting::class, "betNow"]);
	Route::get('/cash_out', [Gamesetting::class, "cashout"]);
    Route::post('/game/currentlybet', [Gamesetting::class, "currentlybet"]);
    Route::post('/game/currentlybetnew', [Gamesetting::class, "currentlybetnew"]);
    Route::post('/game/my_bets_history', [Gamesetting::class, "my_bets_history"]);
    Route::get('/payment_gateway_details', [Adminapi::class, "payment_gateway"]);
    Route::post('/insert/withdrawal', [Adminapi::class, "withdrawal_query"]);
    Route::post('/depositNow', [Adminapi::class, "depositNow"]);
    Route::post('/wallet_transfer', [Userdetail::class, "wallet_transfer"]);
    Route::get('/cronJob', [Gamesetting::class, "cronjob"]);
    Route::post('/updateGameStatus', [Gamesetting::class, "updateGameStatus"]);
    Route::get('/getGameStatus', [Gamesetting::class, "getGameStatus"]);
    Route::post('/game/updateIncNo', [Gamesetting::class, "updateIncrementor"]);
    // Route::get('/support', [SupportController::class, "support"]);
    Route::get('/create', [AdsController::class, "showCreateAd"]);
    Route::post('/create', [AdsController::class, "createNewAd"])->name("addNewaAd");
    // Route::get('/all', [AdsController::class, "showUserAds"]);
    Route::post('/checkAdsExpiration', [AdsController::class, "checkAdsExpiration"]);
    Route::get('/allAds', [AdsController::class, "showUserAds"]);
    Route::post('/allAds', [AdsController::class, "activateAd"]);
    Route::get('/updateBets', [Gamesetting::class, "updateBets"]);
    Route::get('/playads', [Gamesetting::class, "playads"]);
    
    //color prediction game routes
    Route::get('/color-prediction', [ColorPrediction::class, "showColors"]);
    Route::post('/getGameResults', [ColorPrediction::class, "getGameResult"]);
});