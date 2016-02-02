var addProcess = angular.module("addProcessModule", ['angular-repeat-n'])

.config(function($interpolateProvider){
	$interpolateProvider.startSymbol('{[{').endSymbol('}]}');
});

