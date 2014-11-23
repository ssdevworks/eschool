	// public/js/controllers/authCtrl.js
	angular.module('teacherCtrl', [])

.controller('addTeacherController', function ($scope, $http, $window) {
  console.log("Teacher Controller  new reporting for duty.");
  $scope.teacher = {};
  $scope.submitted = false;
  $http.get("/api/teacher/new").then(function(response) {
  	var respData = response.data;
    console.log(response);
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

          console.log(data)
          $scope.msgDisplay = true;
          $scope.sucClass = data.success;
          $scope.errClass = !data.success;
          $scope.notifyMsg = data.message;
        })
    console.log('form submitted');
  } 

  $scope.hasError = function(field, validation){
    if(validation){
      return ($scope.addTeacher[field].$dirty && $scope.addTeacher[field].$error[validation]) || ($scope.submitted && $scope.addTeacher[field].$error[validation]);
    }
    return ($scope.addTeacher[field].$dirty && $scope.addTeacher[field].$invalid) || ($scope.submitted && $scope.addTeacher[field].$invalid);
  };
});
