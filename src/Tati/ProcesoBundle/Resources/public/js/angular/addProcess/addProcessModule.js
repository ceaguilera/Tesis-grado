var addProcess = angular.module("addProcessModule", ['angularjs-autocomplete', 'ngSanitize'])

.config(function($interpolateProvider){
	$interpolateProvider.startSymbol('{[{').endSymbol('}]}');
});

