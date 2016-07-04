listActivity.controller('listActivityController', function($scope, $http, $location, $anchorScroll, $window){

	$scope.response = response;
	$scope.errorRelaciones = false;
	$scope.alerts = [];
	$scope.imprimir = function(){
		console.log("response", $scope.response);
	}
	$scope.redirect = function(){
		var url = Routing.generate('_expertEditProcess', { id: response.id});
		$window.location.href = url;
	}

	$scope.closeAlert = function(index) {
		$scope.alerts.splice(index, 1);
	};

	$scope.validacion = function(){
		angular.forEach($scope.response.actividades, function(actividad, index){

        	if(actividad.actSig===-3 ||  actividad.actAnt===-3){
        		$scope.errorRelaciones = true;
        	}
        	else{
        		$scope.errorRelaciones = false;
        	}
          });
		if($scope.errorRelaciones){
			var alert = {};
			alert.type = 'danger';
			alert.msg = "¡No pueden haber actividades no relacionadas!";
			$scope.alerts.push(alert);
		}
	}
	$scope.addActivity = function(){
		console.log($scope.response);
		if(!$scope.errorRelaciones){
			var json = {};
			json = $scope.response;
			json = angular.toJson(json);
			var url= Routing.generate('_expertActivity');
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
		}else{
			$location.hash('inicio');
            $anchorScroll();
		}
	}
});