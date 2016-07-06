autoridad.controller('autoridadController', function($scope, $http, $window){

	$scope.response = response;
	$scope.responsables = responsables;

	$scope.filtro = function(){
		console.log($scope.filtros);
		// if($scope.filtros.hasOwnProperty('fecha'))
		// 	$scope.filtros.fecha = $scope.filtros.fecha.toLocaleDateString();
		
		var json = {};
		json = $scope.filtros;
		json = angular.toJson(json);
		var url= Routing.generate('_tatiSoft_autoridad_listaProcesos');
		//console.log(url);
		$.ajax({
			method: 'POST',
			data: json,
			url: url,
			success: function(data) {
				console.log(data);
				$scope.response = data;
				$scope.$apply();
			},
			error: function(e) {
				console.log(e);
			}
		})
	}
	$scope.limpiar = function(){
		$scope.response = response;
		$scope.filtros = {};
	}

});