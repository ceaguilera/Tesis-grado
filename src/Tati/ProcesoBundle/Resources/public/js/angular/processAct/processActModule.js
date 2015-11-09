var processAct = angular.module("processActModule", [])

.config(function($interpolateProvider){
	$interpolateProvider.startSymbol('{[{').endSymbol('}]}');
});
