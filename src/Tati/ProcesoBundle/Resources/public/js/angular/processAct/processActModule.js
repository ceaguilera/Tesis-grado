var processAct = angular.module("processActModule", ['mgcrea.ngStrap'])

.config(function($interpolateProvider){
	$interpolateProvider.startSymbol('{[{').endSymbol('}]}');
});
