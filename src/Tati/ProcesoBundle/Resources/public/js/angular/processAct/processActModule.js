var processAct = angular.module("processActModule", ['mgcrea.ngStrap','ui.bootstrap'])

.config(function($interpolateProvider){
	$interpolateProvider.startSymbol('{[{').endSymbol('}]}');
});
