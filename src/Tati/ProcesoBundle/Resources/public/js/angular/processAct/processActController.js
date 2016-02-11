processAct.controller('processActController', function($scope, $http, $window){

	$scope.algo = "HOla MUNDOOOO";
	console.log("algo",$scope.algo);
	$scope.response = response;
	console.log("scope.response",$scope.response);

	$scope.edit = function(id) {
		var url = Routing.generate('_expertEditProcess', { id: id});
		$window.location.href = url;
	}

});