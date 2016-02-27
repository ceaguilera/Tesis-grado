processAct.controller('processActController', function($scope, $http, $window, $modal){

	$scope.algo = "HOla MUNDOOOO";
	console.log("algo",$scope.algo);
	$scope.response = response;
	console.log("scope.response",$scope.response);

	$scope.edit = function(id) {
		var url = Routing.generate('_expertEditProcess', { id: id});
		$window.location.href = url;
	}

	var ModalConfirm = $modal({scope: $scope, template: 'modal-confirm.tpl', show: false});

	$scope.showModalConfirm = function() {
		ModalConfirm.$promise.then(ModalConfirm.show);
	};

	$scope.hideModalConfirm = function() {
		ModalConfirm.$promise.then(ModalConfirm.hide);
	};

});