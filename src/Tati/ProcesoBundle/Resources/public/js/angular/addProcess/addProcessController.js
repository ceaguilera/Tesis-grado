addProcess.controller('addProcessController', function($scope, $http, $window, $location, $anchorScroll){

	$scope.procesoNuevo = {};
	$scope.procesoNuevo.actividades = [];
	$scope.response = response;
	console.log("scope.response",$scope.response);
	$scope.errorProceso = false;

	$scope.validacionProceso = function(){
		if($scope.procesoNuevo.actividades != ""){
			 angular.forEach($scope.procesoNuevo.actividades, function(actividad, index){
                if (actividad.tareas == "") {
                    $scope.errorProceso = true
                }else{
                	$scope.errorProceso = false;
                }
            });
			if($scope.errorProceso){
				$scope.errorMensaje = "Parece que una de las actividad no contiene tareas asociadas, agreguelas e intete de nuevo";
			}
			// //console.log($scope.procesoNuevo.actividades[$scope.procesoNuevo.actividades.length-1]);
			// if($scope.procesoNuevo.actividades[$scope.procesoNuevo.actividades.length-1].length>0){
			// 	console.log("exiten tareas");
			// 	$scope.procesoNuevo.actividades[$scope.procesoNuevo.actividades.length-1].tareasExiste = true;
			// }
			// else{
			// 	console.log("no existen tareas");
			// 	$scope.procesoNuevo.actividades[$scope.procesoNuevo.actividades.length-1].tareasExiste = false;
			// }
		}else{
			$scope.errorProceso = true
			$scope.errorMensaje = "El nuevo proceso debe tener al menos una actividad";
		}


	}


	$scope.add = function(){
		console.log("prueba");
		console.log($scope.procesoNuevo.actividades);

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
		if(!$scope.nuevoProceso.$invalid && !$scope.errorProceso)
		{
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
			        var url = Routing.generate('_expertActivityRelationship', {id:data.id});
	            	$window.location.href = url;
	            	$scope.$apply();
		    	},
		    	error: function(e) {

		    	}
			});        
			
		}else{
			$location.hash('inicio');
            $anchorScroll();
		}
	}


});