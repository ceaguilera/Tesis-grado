var admin = angular.module("adminModule", ['ngSanitize'])

.config(function($interpolateProvider){
	$interpolateProvider.startSymbol('{[{').endSymbol('}]}');
});

