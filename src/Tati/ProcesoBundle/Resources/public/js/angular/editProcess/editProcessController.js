editProcess.controller('editProcessController', function($scope, $http){

	$scope.response = response;
	$scope.procesoNuevo = response;
	console.log("scope.response",$scope.response);

		$scope.addProcess = function(id){
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
	    	},
	    	error: function(e) {

	    	}
		});        
	}
});