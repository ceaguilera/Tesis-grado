listaSolicitudes.controller('listaSolicitudesController', function($scope, $http, $window, Upload){

	$scope.response = response;
	$scope.solicitud = {};
	$scope.imprimir = function(){
		console.log("response", $scope.response);
	}

	$scope.procesarSolicitud = function(){

		$scope.solicitud.userId = $scope.response.userId;
		console.log("entro en aqui");
		var json = {};
		json = $scope.solicitud;
		json = angular.toJson(json);
		var url= Routing.generate('_tatiSoft_soli_solicitud');
		//console.log(url);
		$.ajax({
			method: 'POST',
			data: json,
			url: url,
			success: function(data) {
				console.log("exito");
				console.log(data);
				$scope.actividad = data.actividad;
				$scope.exito = true;
				if(data.actividad){
					var url = Routing.generate('_tatiSoft_soli_getTask', { id: data.idActividad});
					$window.location.href = url;		
				}

				$scope.$apply()
			},
			error: function(e) {

			}
		})
	}

	// $scope.archivoM = function(a){
	// 	console.log($scope.myFile);
	// }

	    $scope.upload = function ($file) {
        // if (files && files.length) {
        //     for (var i = 0; i < files.length; i++) {
        // 		files[i]
        //       var file = files[i];
        //       if (!file.$error) {
        //         Upload.upload({
        //             url: 'https://angular-file-upload-cors-srv.appspot.com/upload',
        //             data: {
        //               username: $scope.username,
        //               file: file  
        //             }
        //         }).then(function (resp) {
        //             $timeout(function() {
        //                 $scope.log = 'file: ' +
        //                 resp.config.data.file.name +
        //                 ', Response: ' + JSON.stringify(resp.data) +
        //                 '\n' + $scope.log;
        //             });
        //         }, null, function (evt) {
        //             var progressPercentage = parseInt(100.0 *
        //             		evt.loaded / evt.total);
        //             $scope.log = 'progress: ' + progressPercentage + 
        //             	'% ' + evt.config.data.file.name + '\n' + 
        //               $scope.log;
        //         });
        //       }
        //     }
        // }
      	var data= {};
   		console.log($scope.file);
		// data.userName = "Carlos";
		// data.name = "prueba";
		// data = angular.toJson(data);
		// // console.log(Upload);
		// var url= Routing.generate('_tatiSoft_soli_upload');
  //       console.log(url);
  //   	Upload.upload({
  //           url: url,
  //           method: 'POST',
  //           file: $file,
  //           data:{headers: {'Content-Type': undefined }
  //           },
  //           transformRequest: angular.identity
  //       }).success(function(data, status, headers, config) {
  //           console.log('success')
  //       }).error(function(data, status, headers, config) {
  //         console.log('error block')
  //     });
    };

});



// listaSolicitudes.controller('listaSolicitudesController', ['$scope', 'Upload', '$timeout', function ($scope, Upload, $timeout) {
//     // $scope.$watch('files', function () {
//     //     $scope.upload($scope.files);
//     // });
//     // $scope.$watch('file', function () {
//     //     if ($scope.file != null) {
//     //         $scope.files = [$scope.file]; 
//     //     }
//     // });
//     // $scope.log = '';

//     $scope.upload = function ($file) {
//         // if (files && files.length) {
//         //     for (var i = 0; i < files.length; i++) {
//         // 		files[i]
//         //       var file = files[i];
//         //       if (!file.$error) {
//         //         Upload.upload({
//         //             url: 'https://angular-file-upload-cors-srv.appspot.com/upload',
//         //             data: {
//         //               username: $scope.username,
//         //               file: file  
//         //             }
//         //         }).then(function (resp) {
//         //             $timeout(function() {
//         //                 $scope.log = 'file: ' +
//         //                 resp.config.data.file.name +
//         //                 ', Response: ' + JSON.stringify(resp.data) +
//         //                 '\n' + $scope.log;
//         //             });
//         //         }, null, function (evt) {
//         //             var progressPercentage = parseInt(100.0 *
//         //             		evt.loaded / evt.total);
//         //             $scope.log = 'progress: ' + progressPercentage + 
//         //             	'% ' + evt.config.data.file.name + '\n' + 
//         //               $scope.log;
//         //         });
//         //       }
//         //     }
//         // }
//       var data= {};
//    console.log($file);
// 		data.userName = "Carlos";
// 		data.name = "prueba";
// 		data = angular.toJson(data);
// 		// console.log(Upload);
// 		var url= Routing.generate('_tatiSoft_soli_upload');
//         console.log(url);
//     	Upload.upload({
//             url: url,
//             method: 'POST',
//             file: $file,
//             data:{headers: {'Content-Type': undefined }
//             },
//             transformRequest: angular.identity
//         }).success(function(data, status, headers, config) {
//             console.log('success')
//         }).error(function(data, status, headers, config) {
//           console.log('error block')
//       });
//     };
// }]);