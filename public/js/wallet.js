var walletApp = angular.module('walletApp', []);

walletApp.controller('appController', function($scope) {
	
	$scope.model = {
		"currentPage" : "create-wallet",
		"selectedWallet" : 0
	}; 

	
	$scope.init = function () {
	
	}
	
	$scope.selectWallet = function (walletId) {
		$scope.selectedWallet = walletId;
		$scope.model.currentPage = "view-wallet";
	}
	
	$scope.selectPage = function (page) {
		$scope.model.currentPage = page;
	}
  });

