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
	$scope.delete=function(posact, postar){
		console.log("entro");
		console.log("posact",posact);
		console.log("postar",postar);
		if(posact!=null && postar!=null){
			console.log("entrosino");
			$scope.procesoNuevo.actividades[posact].tareas.splice(postar, 1);
		}else{
			console.log("entrosi");
			$scope.procesoNuevo.actividades.splice(posact, 1);
		}
	}

	$scope.addProcess = function(){
		var json = {};
		json = $scope.procesoNuevo;
		json.id = null;
	    json = angular.toJson(json);
	    var url= Routing.generate('_expertAddprocess');
	    $.ajax({
	    	method: 'POST',
	    	data: json,
	    	url: url,
	    	success: function(data) {
		        console.log(data);
	    	},
	    	error: function(e) {

	    	}
		});        
	}


});