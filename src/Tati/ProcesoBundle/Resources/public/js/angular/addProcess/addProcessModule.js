var addProcess = angular.module("addProcessModule", ['angularjs-autocomplete', 'ngSanitize', 'ui.bootstrap'])

.config(function($interpolateProvider){
	$interpolateProvider.startSymbol('{[{').endSymbol('}]}');
});

