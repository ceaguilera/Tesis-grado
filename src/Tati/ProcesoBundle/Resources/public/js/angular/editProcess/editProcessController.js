editProcess.controller('editProcessController', function($scope, $http, $window){

	$scope.response = response;
	$scope.procesoNuevo = response;
	console.log("scope.response",$scope.response);
	$scope.errorProceso = false;
	$scope.alerts = [];

	$scope.closeAlert = function(index) {
		$scope.alerts.splice(index, 1);
	};
	$scope.validacionProceso = function(){
		if($scope.procesoNuevo.actividades != ""){
			 angular.forEach($scope.procesoNuevo.actividades, function(actividad, index){
                if (actividad.tareas == "") {
                    $scope.errorProceso = true;
                }else{
                	$scope.errorProceso = false;
                }
            });
			if($scope.errorProceso){
				var alert = {};
				alert.type = 'danger';
				alert.msg = "¡Parece que una de las actividad no contiene tareas asociadas, agreguelas e intete de nuevo!";
				$scope.alerts.push(alert);
			}
		}else{
			$scope.errorProceso = true
			var alert = {};
			alert.type = 'danger';
			alert.msg = "¡El nuevo proceso debe tener al menos una actividad asociada!";
			$scope.alerts.push(alert);
		}


	}
	$scope.addProcess = function(id){
		if(!$scope.errorProceso){
			var json = {};
			json = $scope.procesoNuevo;
			json.id = id;
		    json = angular.toJson(json);
		    var url= Routing.generate('_expertAddprocess');
		    $.ajax({
		    	method: 'POST',
		    	data: json,
		    	url: url,
		    	success: function(data) {
			        console.log(data);
			        var url = Routing.generate('_expertActivityRelationship', {id:response.id});
	            	$window.location.href = url;
	            	$scope.$apply();
		    	},
		    	error: function(e) {

		    	}
			});    
		}
	}
	$scope.redirect = function(){
		var url = Routing.generate('_expertActivityRelationship', { id: response.id});
		$window.location.href = url;
	}
});