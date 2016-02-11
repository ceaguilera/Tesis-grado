var editProcess = angular.module("editProcessModule", ['angular-repeat-n'])

.config(function($interpolateProvider){
	$interpolateProvider.startSymbol('{[{').endSymbol('}]}');
});

