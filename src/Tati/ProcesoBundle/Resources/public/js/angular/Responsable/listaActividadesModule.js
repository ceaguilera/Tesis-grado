var listaActividades = angular.module("listaActividadesModule", ['ngFileUpload', 'ui.bootstrap'])

.config(function($interpolateProvider){
	$interpolateProvider.startSymbol('{[{').endSymbol('}]}');
});
