listaActividades.controller('listaActividadesController', function($scope, $http, $window){

	$scope.response = response;
	$scope.solicitud = {};

	$scope.ejecutarActividad = function(idActividad){
		var url = Routing.generate('_tatiSoft_soli_getTask', { id: idActividad});
		$window.location.href = url;
	}
})
