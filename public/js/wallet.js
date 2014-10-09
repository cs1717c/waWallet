var fruglApp = angular.module('fruglApp', ['ngCookies', 'ngResource']);

fruglApp.controller('appController', function($scope, $cookies, $resource, $http, $timeout) {
	
	$scope.model = {
		"currentPage" : "browse",

		"currentUser" : {
			"cart" : {}
		},
		
		
	}; 

	
	$scope.init = function () {

	}
	
	$scope.onClickPage = function (page) {
		$scope.model.currentPage = page;
	}
	
	function getRefParam(ref, param)
	{
		ref = ref.split("/");
		return ref[param];
	}
  });

