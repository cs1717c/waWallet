<?php


class WalletController extends BaseController
{
    public function getWallets()
    {
        return Wallet::all()->toJson();
    }

    public function getWallet($wallet)
    {
		$wallet = Wallet::find($wallet);
		$walletArr = $wallet->toArray();
		
		$transactions = WalletTransaction::where('wallet', $wallet->id)->get();
		$walletArr['transactions'] = $transactions->toArray();
		
		$balance = 0;
		foreach ($transactions as $transaction)
			$balance += $transaction["amount"];
			
		$walletArr["balance"] = number_format($balance,2);
		
        return json_encode($walletArr);
    }

    public function editWallet($wallet)
    {
		$input = Input::json();
		
        $wallet = Wallet::find($wallet);
	
		if  (Input::has('name'))
			$wallet->name = $input->get('name');
			
		if  (Input::has('name'))
			$wallet->currency = $input->get('currency');
     
        $wallet->save();
        return $wallet->toJson();
    }
	
    public function addWallet()
    {
        $input = Input::json();

        $wallet = new Wallet;
        $wallet->name = $input->get('name');
        $wallet->currency = $input->get('currency');
     
        $wallet->save();
        return $wallet->toJson();
    }
	
	public function deleteWallet()
	{
		$wallet = Wallet::find(Input::get('id'));
		$wallet->delete();
		return $wallet->toJson();
	}

}