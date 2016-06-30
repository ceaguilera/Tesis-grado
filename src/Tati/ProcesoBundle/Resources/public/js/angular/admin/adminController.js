admin.controller('adminController', function($scope, $http, $window){

	$scope.response = response;
	$scope.datos = {};
	$scope.responsables = [];
	$scope.responsables.length++;
	$scope.responsables[0] ={};
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

	 $scope.addResponsables = function(){
	 	$scope.responsables[$scope.responsables.length] = {};
	 }
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
	 			var url = Routing.generate('_tatiSoft_admin_listUsers');
				$window.location.href = url;
	 			$scope.$apply();
	 		},
	 		error: function(e) {
	 		}
	 	});
	 }

	$scope.registrarResponsable = function(){
	 	console.log($scope.responsables);
	 	var json = {};
	 	json = $scope.responsables;
	 	//json.tipo = tipo;
	 	json = angular.toJson(json);
	 	console.log(json);
	 	var url= Routing.generate('_tatiSoft_admin_register_rep');
	 	$.ajax({
	 		method: 'POST',
	 		data: json,
	 		url: url,
	 		success: function(data) {
	 			console.log(data);
	 			var url = Routing.generate('_tatiSoft_admin_addUserEspecialista');
				$window.location.href = url;
	 			$scope.$apply();
	 		},
	 		error: function(e) {
	 		}
	 	});
	 }

});