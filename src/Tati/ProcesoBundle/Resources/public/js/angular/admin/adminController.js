admin.controller('adminController', function($scope, $http, $window){

	$scope.response = response;
	$scope.datos = {};
	 $scope.$watch('departamento', function() {
	 	console.log($scope.departamento);
	 	var json = {};
	 	json.departamentoId = $scope.departamento;
	 	json = angular.toJson(json);
	 	console.log(json);
	 	var url= Routing.generate('_tatiSoft_admin_getUnit');
	 	$.ajax({
	 		method: 'POST',
	 		data: json,
	 		url: url,
	 		success: function(data) {
	 			$scope.unidades = data;
	 			$scope.$apply();
	 		},
	 		error: function(e) {
	 		}
	 	});        
	 });

	 $scope.$watch('responsable', function() {
	 	console.log("entro", $scope.responsable);

	 	if($scope.responsable == 1){
	 		$scope.datos.responsabilidades = [];
	 		$scope.datos.responsabilidades[$scope.datos.responsabilidades.length] = {};
	 	}

	 });

	 $scope.addResponsa = function(){
	 	$scope.datos.responsabilidades[$scope.datos.responsabilidades.length] = {};
	 }


	 $scope.registrar = function(tipo){
	 	$scope.datos.departamento = $scope.departamento;
	 	console.log($scope.datos);
	 	var json = {};
	 	json.datos = $scope.datos;
	 	//json.tipo = tipo;
	 	json = angular.toJson(json);
	 	console.log(json);
	 	var url= Routing.generate('_tatiSoft_admin_register');
	 	$.ajax({
	 		method: 'POST',
	 		data: json,
	 		url: url,
	 		success: function(data) {
	 			console.log(data);
	 			$scope.$apply();
	 		},
	 		error: function(e) {
	 		}
	 	});
	 }

});