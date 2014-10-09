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
Route::get('/wallet', 'WalletController@getWallets'); 
Route::get('/wallet/{id}', 'WalletController@getWallet');
Route::post('/wallet/{id}', 'WalletController@editWallet');
Route::put('/wallet', 'WalletController@addWallet');