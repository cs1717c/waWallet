<?php


class WalletController extends BaseController
{
    public function getWallets()
    {
        return Wallet::all()->toJson();
    }

    public function getWallet($id)
    {
        return Wallet::find($id)->toJson();
    }

    public function editWallet($id)
    {
        return Wallet::find($id)->toJson();
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