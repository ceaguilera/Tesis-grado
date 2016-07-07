var listaActividades = angular.module("listaActividadesModule", ['ui.bootstrap'])

.config(function($interpolateProvider){
	$interpolateProvider.startSymbol('{[{').endSymbol('}]}');
});
