var listaActividades = angular.module("listaActividadesModule", ['ngFileUpload'])

.config(function($interpolateProvider){
	$interpolateProvider.startSymbol('{[{').endSymbol('}]}');
});
