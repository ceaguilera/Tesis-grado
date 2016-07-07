processAct.controller('processActController', function($scope, $http, $window){

	$scope.algo = "HOla MUNDOOOO";
	console.log("algo",$scope.algo);
	$scope.response = response;
	console.log("scope.response",$scope.response);
	$scope.alerts = [];

	$scope.closeAlert = function(index) {
		$scope.alerts.splice(index, 1);
	};

	$scope.edit = function(id) {
		var url = Routing.generate('_expertEditProcess', { id: id});
		$window.location.href = url;
	}

	$scope.desactivar = function(id, pos){
		console.log(id,pos);

		var json = {};
		json.id = id;
		json.status = false;
	 	json = angular.toJson(json);
	 	console.log(json);
	 	var url= Routing.generate('_expert_activar_desactivar_Proceso');
	 	$.ajax({
	 		method: 'POST',
	 		data: json,
	 		url: url,
	 		success: function(data) {
	 			$scope.response.splice(pos, 1);
	 			var alert = {};
				alert.type = 'success';
				alert.msg = data;
				$scope.alerts.push(alert);
	 			$scope.$apply();
	 		},
	 		error: function(e) {
	 		}
	 	});      
	}

});