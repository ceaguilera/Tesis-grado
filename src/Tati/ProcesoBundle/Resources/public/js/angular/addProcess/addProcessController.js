addProcess.controller('addProcessController', function($scope, $http){

	$scope.procesoNuevo = {};
	$scope.procesoNuevo.actividades = [];
	$scope.response = response;
	console.log("scope.response",$scope.response);

	$scope.add = function(){
		console.log("prueba");
		$scope.procesoNuevo.actividades.length++;
		 var pos = $scope.procesoNuevo.actividades.length;
		 //console.log("pos1", pos);
		 $scope.procesoNuevo.actividades[pos-1] = {};
		 //console.log("$scope.procesoNuevo.actividades",$scope.procesoNuevo.actividades);
		 $scope.procesoNuevo.actividades[pos-1].tareas = [];
		 //console.log("$scope.procesoNuevo.actividades",$scope.procesoNuevo.actividades);
	}
	$scope.addTarea = function(){
		var pos = $scope.procesoNuevo.actividades.length;
		console.log("pos2", pos);
		$scope.procesoNuevo.actividades[pos-1].tareas.length++;
	}
	$scope.impress=function(){
		console.log("$scope.procesoNuevo",$scope.procesoNuevo);
	}
});