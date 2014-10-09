var walletApp = angular.module('walletApp', ['ngResource']);



walletApp.controller('walletApp.appController', function($scope, $resource) {
	
	$scope.app = {
		"currentPage" : "",
		"selectedWallet" : [],
		"menuHidden" : true,
		"amountToAdd" : '',
		"loading" : true
	}; 
	
	var Wallet = $resource('/wallets/:walletId',
	 {walletId:'@id'}, {
		update : { method : 'put'},
		create : { method : 'post'},
	 });

	 var Currency = $resource('/currencies/:currencyId',
	 {currencyId:'@id'}, {
		update : { method : 'put'},
		create : { method : 'post'},
	 });
	 
	var Transaction = $resource('/wallets/:walletId/transactions/:transactionId',
	 {walletId:'@wallet', transactionId: '@id'}, {
		update : { method : 'put'},
		create : { method : 'post'},
	 });
	
	$scope.app.wallets = Wallet.query(function(){$scope.app.loading = false});
	$scope.app.currencies = Currency.query();
	$scope.app.newTransaction = new Transaction;
	
	$scope.init = function () {
		$scope.app.loading = true;
		$scope.selectPage('create-wallet');
	}
	
	$scope.selectWallet = function (wallet) {
		$scope.app.loading = true;
		var walletFromServer = Wallet.get({}, {id : wallet.id}, function()
		{
		
			$scope.app.selectedWallet = walletFromServer;
			$scope.app.selectedWallet.transactions = Transaction.query({walletId : walletFromServer.id});
			$scope.app.selectedWallet.currencyCode = 'cur';
			$scope.app.currencies.forEach (function (item) {
				if (item.id == walletFromServer.currency)
				{
					$scope.app.selectedWallet.currencyCode = item.code;
					$scope.app.selectedWallet.currencyCodeCaps = item.code.toUpperCase();
				}
			});
			
			$scope.app.currentPage = "view-wallet";
			$scope.app.loading = false;
		});
	}
	
	$scope.deleteWallet = function(wallet)
	{
		$scope.app.loading = true;
		Wallet.delete(wallet, function()
		{
			$scope.app.wallets = Wallet.query(function(){
				selectPage('create-wallet');
				$scope.app.loading = false;}); 
		} );
	}
	
	$scope.updateWallet = function(wallet)
	{
		$scope.app.loading = true;
		Wallet.update(wallet, function(){$scope.app.loading = false;});
	}
	
	$scope.createWallet = function(wallet)
	{
		$scope.app.loading = true;
		Wallet.create(wallet, function()
		{
			$scope.app.wallets = Wallet.query(function(){$scope.app.loading = false;})
		});
	}
	
	$scope.addTransaction = function (amount, mode)
	{
		if (mode == 'debit')
			amount = -amount;
			
		var transaction = new Transaction;
		transaction.amount = amount;			
		transaction.wallet = $scope.app.selectedWallet.id;
				
		$scope.app.loading = true;
		Transaction.create(transaction, function()
			{
				$scope.app.selectedWallet.transactions = Transaction.query({walletId : transaction.wallet}); 
				$scope.selectWallet($scope.app.selectedWallet); //refresh the balance
				$scope.amountToAdd = '';
			} );
			
		$scope.resetTransaction();
	}
	
	$scope.resetTransaction = function()
	{
		$scope.newTransaction = new Transaction;
	}
	
	$scope.toggleMenu = function()
	{
		$scope.app.menuHidden = !$scope.app.menuHidden;
	}
	
	$scope.getCurrencyCodeFromId = function(id)
	{
		console.log("ID "+id);
		
	}
	
	$scope.selectPage = function (page) {
		$scope.app.currentPage = page;
		
		if (page == 'create-wallet')
			$scope.app.selectedWallet = new Wallet;
	}
  });

