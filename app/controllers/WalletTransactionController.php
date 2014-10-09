<?php


class WalletTransactionController extends BaseController
{
    public function getWalletTransactions()
    {
        return WalletTransaction::all()->toJson();
    }

    public function getWalletTransaction($wallet)
    {
        return WalletTransaction::find($wallet)->toJson();
    }

    public function getWalletTransaction($wallet)
    {
        return WalletTransaction::find($wallet)->toJson();
    }
	
    public function getWalletTransaction()
    {
        $input = Input::json();

        $transaction = new WalletTransaction;
        $transaction->wallet = $input->get('wallet');
        $transaction->amount = $input->get('amount');
     
        $transaction->save();
        return $transaction->toJson();
    }

}