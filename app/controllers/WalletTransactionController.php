<?php


class WalletTransactionController extends BaseController
{
    public function getAllTransactions()
    {
        return WalletTransaction::find()->toJson();
    }

	public function getWalletTransactions($wallet)
    {
		return WalletTransaction::where('wallet', $wallet)->get()->toJson();
    }
	
    public function getWalletTransaction($transaction)
    {
        return WalletTransaction::find($transaction)->toJson();
    }

    public function editWalletTransaction($transaction)
    {
		$input = Input::json();
		
        $transaction = WalletTransaction::find($transaction);
	
		if  (Input::has('amount'))
			$transaction->amount = $input->get('amount');
     
        $transaction->save();
        return $transaction->toJson();
    }
	
    public function addWalletTransaction()
    {
        $input = Input::json();
		
		$walletId = $input->get('wallet');

        $transaction = new WalletTransaction;
        $transaction->wallet = $walletId;
        $transaction->amount = $input->get('amount');
		
		$wallet = Wallet::find($walletId);
		
		if (!$wallet)
			return json_encode(array("error" => "bad_wallet"));
		
		$transactions = WalletTransaction::where('wallet', $walletId)->get();
		$transactionsArr = $transactions->toArray();
		
		$balance = 0;
		foreach ($transactionsArr as $walletTransaction)
			$balance += $walletTransaction["amount"];
			
		if ($balance < 0)
			return json_encode(array("error" => "bad_transaction"));
			     
        $transaction->save();
        return $transaction->toJson();
    }

}