var processInact = angular.module("processInactModule", ['ui.bootstrap'])

.config(function($interpolateProvider){
	$interpolateProvider.startSymbol('{[{').endSymbol('}]}');
});
