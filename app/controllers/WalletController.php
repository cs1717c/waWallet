<?php


class WalletController extends BaseController
{
    public function getWallets()
    {
        return Wallet::all()->toJson();
    }

    public function getWallet($wallet)
    {
        return Wallet::find($wallet)->toJson();
    }

    public function editWallet($wallet)
    {
        return Wallet::find($wallet)->toJson();
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

}