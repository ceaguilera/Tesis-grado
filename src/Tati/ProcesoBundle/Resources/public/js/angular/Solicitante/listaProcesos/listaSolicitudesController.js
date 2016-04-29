listaSolicitudes.controller('listaSolicitudesController', function($scope, $http){

	$scope.response = response;
	$scope.solicitud = {};
	$scope.imprimir = function(){
		console.log("response", $scope.response);
	}

	$scope.procesarSolicitud = function(){

		$scope.solicitud.userId = $scope.response.userId;
		console.log($scope.solicitud);
		var json = {};
		json = $scope.solicitud;
		json = angular.toJson(json);
		var url= Routing.generate('_tatiSoft_soli_solicitud');
		console.log(url);
		$.ajax({
			method: 'POST',
			data: json,
			url: url,
			success: function(data) {
				console.log(data);
			},
			error: function(e) {

			}
		})
	}

});