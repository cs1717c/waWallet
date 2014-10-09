<?php


class CurrencyController extends BaseController
{
    public function getCurrencies()
    {
        return Currency::all()->toJson();
    }

    public function getCurrency($currency)
    {
        return Currency::find($currency)->toJson();
    }

}