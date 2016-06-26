var listaActividades = angular.module("listaActividadesModule", [])

.config(function($interpolateProvider){
	$interpolateProvider.startSymbol('{[{').endSymbol('}]}');
});
