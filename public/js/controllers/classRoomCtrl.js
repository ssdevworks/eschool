angular.module('classRoomCtrl', [])

.controller('AddClassRoomController', function ($scope, $http, $window) {
  console.log("classRoom Controller  new reporting for duty.");
  $scope.classRoom = {};
  $scope.submitted = false;
  $http.get("/api/classroom/new").then(function(response) {
  	var respData = response.data;
    $scope.teachers = respData.teachers;
  })
  $scope.addNewClassRoom = function() {
    $scope.submitted = true;
    $scope.msgDisplay = false;
    if(!$scope.addClassRoom.$valid) {return;}
    $http({
          method: 'POST',
          url: '/api/classroom/new',
          headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
          data: $.param($scope.classRoom)
        }).success(function(data){
          $scope.msgDisplay = true;
          $scope.sucClass = data.success;
          $scope.notifyMsg = data.message;
          if (data.success) {
            $scope.resetForm();
          }
        })
    console.log('form submitted');
  } 
  $scope.resetForm = function() {    
    $scope.classRoom = {};
    $scope.addClassRoom.$setPristine();
  }

  $scope.hasError = function(field, validation){
    if(validation){
      return ($scope.addClassRoom[field].$dirty && $scope.addClassRoom[field].$error[validation]) || ($scope.submitted && $scope.addClassRoom[field].$error[validation]);
    }
    return ($scope.addClassRoom[field].$dirty && $scope.addClassRoom[field].$invalid) || ($scope.submitted && $scope.addClassRoom[field].$invalid);
  };
})
.controller('EditClassRoomController', function ($scope, $http, $window) {
  console.log("Edit ClassRoom Controller reporting for duty.");
  console.log('classRoom id =>' + $scope.classRoomId);
  $scope.classRoom = {};
  $scope.submitted = false;
  $http.get("/api/classroom/edit/" + $scope.classRoomId).then(function(response) {
    var respData = response.data;
    $scope.teachers = respData.teachers;
    $scope.classRoom = respData.classroom;
  })
  $scope.updateClassRoom = function() {
    $scope.submitted = true;
    $scope.msgDisplay = false;
    if(!$scope.editClassRoom.$valid) {return;}
    $http({
          method: 'POST',
          url: '/api/classroom/edit/' + $scope.classRoomId,
          headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
          data: $.param($scope.classRoom)
        }).success(function(data){
          $scope.msgDisplay = true;
          $scope.sucClass = data.success;
          $scope.notifyMsg = data.message;
          if (data.success) {
            
          }
        })
    console.log('form submitted');
  } 
  $scope.resetForm = function() {    
    $scope.classRoom= {};
    $scope.editClassRoom.$setPristine();
  }

  $scope.hasError = function(field, validation){
    if(validation){
      return ($scope.editClassRoom[field].$dirty && $scope.editClassRoom[field].$error[validation]) || ($scope.submitted && $scope.editClassRoom[field].$error[validation]);
    }
    return ($scope.editClassRoom[field].$dirty && $scope.editClassRoom[field].$invalid) || ($scope.submitted && $scope.editClassRoom[field].$invalid);
  };
})
.controller('ListClassRoomController', function ($scope, $http, $window) {
  console.log("List ClassRoom Controller  new reporting for duty.");
  $scope.searchFilter = {};
  $scope.classRooms = {};
  $http.get("/api/classroom/list").then(function(response) {
    $scope.classRooms = response.data.classrooms;
  })  

  })
.controller('ClassRoomDetailsController', function ($scope, $http, $window) {
  console.log("Details ClassRoom Controller  new reporting for duty.");
  $scope.classRoom = {};
  $http.get("/api/classroom/details/" + $scope.classRoomId).then(function(response) {
    $scope.classRoom = response.data.classroom;
        
  })  
})
;
