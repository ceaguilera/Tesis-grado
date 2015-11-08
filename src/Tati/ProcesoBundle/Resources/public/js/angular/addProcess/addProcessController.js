addProcess.controller('addProcessController', function($scope, $http){

	$scope.procesoNuevo = {};
	$scope.procesoNuevo.actividades = [];
	$scope.response = response;
	console.log("scope.response",$scope.response);

	$scope.add = function(){
		console.log("prueba");
		$scope.procesoNuevo.actividades.length++;
		$scope.actActual = $scope.procesoNuevo.actividades.length-1;
		console.log("$scope.actActual",$scope.actActual);
		 //console.log("pos1", pos);
		 $scope.procesoNuevo.actividades[$scope.actActual] = {};
		 //console.log("$scope.procesoNuevo.actividades",$scope.procesoNuevo.actividades);
		 $scope.procesoNuevo.actividades[$scope.actActual].tareas = [];
		 //console.log("$scope.procesoNuevo.actividades",$scope.procesoNuevo.actividades);
	}
	$scope.addTarea = function(){
	
		$scope.procesoNuevo.actividades[$scope.actActual].tareas.length++;
		$scope.tareaAct = $scope.procesoNuevo.actividades[$scope.actActual].tareas.length-1;
	}
	$scope.impress=function(){
		console.log("$scope.procesoNuevo",$scope.procesoNuevo);
	}
});