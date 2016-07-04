var listActivity = angular.module("listActivityModule", ['ui.bootstrap'])

.config(function($interpolateProvider){
	$interpolateProvider.startSymbol('{[{').endSymbol('}]}');
});

listActivity.directive('numberConverter', function() {
    return {
        priority: 1,
        restrict: 'A',
        require: 'ngModel',
        link: function(scope, element, attr, ngModel) {
            function toModel(value) {
                return parseInt(value); // convert to number
            }

            function toView(value) {
                return "" + value; // convert to string
            }

            ngModel.$formatters.push(toView);
            ngModel.$parsers.push(toModel);
        }
    };
});