 <?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
//HOME CALLS
Route::get('/', function()
{
    return View::make('home', array());
}); 


//WALLET CALLS
Route::get('/wallets', 'WalletController@getWallets'); 
Route::get('/wallets/{wallet}', 'WalletController@getWallet');
Route::post('/wallets/{wallet}', 'WalletController@editWallet');
Route::put('/wallets', 'WalletController@addWallet');


//TRANSACTION CALLS
Route::get('/wallets/{wallet}/transactions', 'WalletTransactionController@getWalletTransactions');
Route::get('/wallets/{wallet}/transactions/{transaction}', 'WalletTransactionController@getWalletTransaction');
Route::post('/wallets/{wallet}/transactions', 'WalletController@editWalletTransaction');
Route::put('/wallets/{wallet}/transactions', 'WalletController@addWalletTransaction');