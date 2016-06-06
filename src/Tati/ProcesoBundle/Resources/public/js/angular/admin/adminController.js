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

	 $scope.registrar = function(){
	 	$scope.datos.departamento = $scope.departamento;
	 	var json = {};
	 	json.datos = $scope.datos;
	 	json.tipo = 1;
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