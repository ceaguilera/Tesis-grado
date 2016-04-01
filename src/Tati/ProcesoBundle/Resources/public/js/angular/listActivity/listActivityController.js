listActivity.controller('listActivityController', function($scope, $http){

	$scope.response = response;
	$scope.imprimir = function(){
		console.log("response", $scope.response);
	}
	$scope.addActivity = function(){
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
	}
});