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
Route::post('/wallets', 'WalletController@addWallet');
Route::get('/wallets', 'WalletController@getWallets'); 
Route::get('/wallets/{wallet}', 'WalletController@getWallet');
Route::put('/wallets/{wallet}', 'WalletController@editWallet');
Route::delete('/wallets', 'WalletController@deleteWallet');

//CURRENCY CALLS
Route::get('/currencies', 'CurrencyController@getCurrencies'); 
Route::get('/currencies/{currency}', 'CurrencyController@getCurrency');

//TRANSACTION CALLS
Route::get('/wallets/transactions', 'WalletTransactionController@getAllTransactions');
Route::post('/wallets/{wallet}/transactions', 'WalletTransactionController@addWalletTransaction');
Route::get('/wallets/{wallet}/transactions', 'WalletTransactionController@getWalletTransactions');
Route::get('/wallets/{wallet}/transactions/{transaction}', 'WalletTransactionController@getWalletTransaction');
Route::put('/wallets/{wallet}/transactions/{transaction}', 'WalletController@editWalletTransaction');