	// public/js/controllers/authCtrl.js
	angular.module('teacherCtrl', [])

.controller('AddTeacherController', function ($scope, $http, $window) {
  console.log("Teacher Controller  new reporting for duty.");
  $scope.teacher = {};
  $scope.submitted = false;
  $http.get("/api/teacher/new").then(function(response) {
  	var respData = response.data;
    $scope.genders = respData.genders;  
    $scope.subjects = respData.subjects;  
    $scope.marital_status = respData.marital_status;
    $scope.blood_groups = respData.blood_groups;
    
    })
  $scope.addNewTeacher = function() {
    $scope.submitted = true;
    $scope.msgDisplay = false;
    if(!$scope.addTeacher.$valid) {return;}
    $http({
          method: 'POST',
          url: '/api/teacher/new',
          headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
          data: $.param($scope.teacher)
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
    $scope.teacher= {};
    $scope.addTeacher.$setPristine();
  }

  $scope.hasError = function(field, validation){
    if(validation){
      return ($scope.addTeacher[field].$dirty && $scope.addTeacher[field].$error[validation]) || ($scope.submitted && $scope.addTeacher[field].$error[validation]);
    }
    return ($scope.addTeacher[field].$dirty && $scope.addTeacher[field].$invalid) || ($scope.submitted && $scope.addTeacher[field].$invalid);
  };
})
.controller('EditTeacherController', function ($scope, $http, $window) {
  console.log("Edit Teacher Controller reporting for duty.");
  console.log('teacher id =>' + $scope.teacherId);
  $scope.teacher = {};
  $scope.submitted = false;
  $http.get("/api/teacher/edit/" + $scope.teacherId).then(function(response) {
    var respData = response.data;
    $scope.genders = respData.genders;  
    $scope.subjects = respData.subjects;  
    $scope.marital_status = respData.marital_status;
    $scope.blood_groups = respData.blood_groups;
    $scope.teacher = respData.teacher;
    })
  $scope.addNewTeacher = function() {
    $scope.submitted = true;
    $scope.msgDisplay = false;
    if(!$scope.editTeacher.$valid) {return;}
    $http({
          method: 'POST',
          url: '/api/teacher/new',
          headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
          data: $.param($scope.teacher)
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
    $scope.teacher= {};
    $scope.editTeacher.$setPristine();
  }

  $scope.hasError = function(field, validation){
    if(validation){
      return ($scope.editTeacher[field].$dirty && $scope.editTeacher[field].$error[validation]) || ($scope.submitted && $scope.editTeacher[field].$error[validation]);
    }
    return ($scope.editTeacher[field].$dirty && $scope.editTeacher[field].$invalid) || ($scope.submitted && $scope.editTeacher[field].$invalid);
  };
})
.controller('ListTeacherController', function ($scope, $http, $window) {
  console.log("List Teacher Controller  new reporting for duty.");
  $scope.teachers = {};
  $scope.submitted = false;
  $http.get("/api/teacher/list").then(function(response) {
    $scope.teachers = response.data;
        
    })
  
})
;
