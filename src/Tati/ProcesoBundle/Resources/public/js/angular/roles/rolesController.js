roles.controller('rolesController', function($scope, $http, $window){

	$scope.algo = "HOla MUNDOOOO";
	console.log("algo",$scope.algo);
	$scope.response = response;

	$scope.redirect = function(id){
	 	var url = Routing.generate('_tatiSoft_admin_edit_user', {id:id});
		$window.location.href = url;
	 }
});