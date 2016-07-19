listaActividades.controller('listaActividadesController', function($scope, $http, $window, Upload){

	$scope.response = response;
	$scope.solicitud = {};
	$scope.alerts = [];
	$scope.closeAlert = function(index, typeAlert) {
		$scope.alerts.splice(index, 1);
		if(typeAlert != 1){
			var url = Routing.generate('_tatiSoft_resp_end_acitivity');
			$window.location.href = url;
		}
	};

	$scope.detalleActividad = function(idActividad){
		var url = Routing.generate('_tatiSoft_resp_getTask', { id: idActividad});
		$window.location.href = url;
	}

	 $scope.ejecutarTarea = function(tareaId, key){
    	var json = {};
		json.idTarea = tareaId;
		json = angular.toJson(json);
		var url= Routing.generate('_tatiSoft_resp_setTask');
		//console.log(url);
		$.ajax({
			method: 'POST',
			data: json,
			url: url,
			success: function(data) {
				console.log(data);
				$scope.response.actividad.tareas[key].ejecutada = true;
				console.log(response);
				var alert = {};
				alert.type = 'success';
				alert.msg = data;
				alert.typeAlert = 1;
				$scope.alerts.push(alert);
				$scope.$apply();
			},
			error: function(e) {
				console.log(e);
			}
		})
	}

	$scope.ejecutarActividad = function(){
    	var json = {};
		json.idActividad = response.actividad.id;
		json = angular.toJson(json);
		var url= Routing.generate('_tatiSoft_resp_setActividad');
		//console.log(url);
		$.ajax({
			method: 'POST',
			data: json,
			url: url,
			success: function(data) {
				console.log(data);
				var alert = {};
				alert.type = 'success';
				alert.typeAlert = 2;
				alert.msg = data;
				$scope.alerts.push(alert);
				$scope.$apply();
			},
			error: function(e) {
				console.log(e);
				var alert = {};
				alert.type = 'danger';
				alert.typeAlert = 1;
				alert.msg = e.responseJSON;
				$scope.alerts.push(alert);
				$scope.$apply();
			}
		})
    }

    $scope.devolverActividad = function(mensaje){
    	var json = {};
		json.idActividad = response.actividad.id;
		json.mensaje = mensaje;
		json = angular.toJson(json);
		var url= Routing.generate('_tatiSoft_resp_devolverActividad');
		console.log(json.mensaje);
		$.ajax({
			method: 'POST',
			data: json,
			url: url,
			success: function(data) {
				console.log(data);
				var alert = {};
				alert.type = 'success';
				alert.typeAlert = 2;
				alert.msg = data;
				$scope.alerts.push(alert);
				$scope.$apply();
			},
			error: function(e) {
				console.log(e);
				
			}
		})
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

	 $scope.upload = function ($file, key) {
	      	var json= {};
	   		console.log($file);
			var userName = $scope.response.nombreUser;
			var name = $scope.response.actividad.tareas[key].nombre;
			var idTarea = $scope.response.actividad.tareas[key].id;
			var actividadRelacionada = response.actividad.id;
			//json = angular.toJson(json);
			console.log(json);
			// console.log(Upload);
			var url= Routing.generate('_tatiSoft_soli_upload');
	        console.log(url);
	    	Upload.upload({
	            url: url,
	            method: 'POST',
	            file: $file,
	            data:{headers: {'Content-Type': undefined}
	            , 'userName': userName, 'name': name, 'actividadRelacionada': actividadRelacionada, 'idTarea': idTarea },
	            transformRequest: angular.identity
	        }).success(function(data) {
	            console.log('success');
	            console.log(data);
	            $scope.response.actividad.tareas[key].filePath = data.path;
	            $scope.response.actividad.tareas[key].fileName = data.nombre;
	           	$scope.response.actividad.tareas[key].fileId = data.fileId;
	            $scope.response.actividad.tareas[key].subido = true;
	        }).error(function(data) {
	          console.log('error block');
	          console.log(data);
	      });
    };

      $scope.eliminarArchivo = function(id, pos){
    	 var json = {};
		json.idFile = id;
		json = angular.toJson(json);
		var url= Routing.generate('_tatiSoft_soli_eliminar_archivo');
		//console.log(url);
		$.ajax({
			method: 'POST',
			data: json,
			url: url,
			success: function(data) {
				console.log(data);
				var alert = {};
				alert.type = 'success';
				alert.msg = data;
				$scope.alerts.push(alert);
				$scope.response.actividad.tareas[pos].filePath = false;
				$scope.$apply();
			},
			error: function(e) {
				console.log(e);
				var alert = {};
				alert.type = 'danger';
				alert.msg = e.responseJSON;
				$scope.alerts.push(alert);
				$scope.$apply();
			}
		})
    }

    
})
