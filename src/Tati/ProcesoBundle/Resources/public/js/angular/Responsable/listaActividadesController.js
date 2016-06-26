listaActividades.controller('listaActividadesController', function($scope, $http, $window){

	$scope.response = response;
	$scope.solicitud = {};

	$scope.detalleActividad = function(idActividad){
		var url = Routing.generate('_tatiSoft_resp_getTask', { id: idActividad});
		$window.location.href = url;
	}

	 $scope.ejecutarTarea = function(tareaId){
    	var json = {};
		json.idTarea = tareaId;
		json = angular.toJson(json);
		var url= Routing.generate('_tatiSoft_resp_setTask');
		//console.log(url);
		$.ajax({
			method: 'POST',
			data: json,
			url: url,
			success: function(data) {
				console.log(data);
			},
			error: function(e) {
				console.log(e);
			}
		})
	}

	    $scope.ejecutarActividad = function(){
    	var json = {};
		json.idActividad = response.actividad.id;
		json = angular.toJson(json);
		var url= Routing.generate('_tatiSoft_resp_setActividad');
		//console.log(url);
		$.ajax({
			method: 'POST',
			data: json,
			url: url,
			success: function(data) {
				console.log(data);
			},
			error: function(e) {
				console.log(e);
			}
		})
    }
    
})
