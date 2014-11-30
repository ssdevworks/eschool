angular.module('studentCtrl', [])

.controller('AddStudentController', function ($scope, $http, $window) {
  console.log("student Controller  new reporting for duty.");
  $scope.student = {};
  $scope.submitted = false;
  $http.get("/api/student/new").then(function(response) {
  	var respData = response.data;
    $scope.genders = respData.genders;  
    $scope.class_rooms = respData.class_rooms;
    $scope.blood_groups = respData.blood_groups;
    
    })
  $scope.addNewStudent = function() {
    $scope.submitted = true;
    $scope.msgDisplay = false;
    if(!$scope.addStudent.$valid) {return;}
    $http({
          method: 'POST',
          url: '/api/student/new',
          headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
          data: $.param($scope.student)
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
    $scope.student= {};
    $scope.addStudent.$setPristine();
  }

  $scope.hasError = function(field, validation){
    if(validation){
      return ($scope.addStudent[field].$dirty && $scope.addStudent[field].$error[validation]) || ($scope.submitted && $scope.addStudent[field].$error[validation]);
    }
    return ($scope.addStudent[field].$dirty && $scope.addStudent[field].$invalid) || ($scope.submitted && $scope.addStudent[field].$invalid);
  };
})
.controller('EditStudentController', function ($scope, $http, $window) {
  console.log("Edit Student Controller reporting for duty.");
  console.log('student id =>' + $scope.studentId);
  $scope.student = {};
  $scope.submitted = false;
  $http.get("/api/student/edit/" + $scope.studentId).then(function(response) {
    var respData = response.data;
    $scope.genders = respData.genders;  
    $scope.class_rooms = respData.class_rooms;
    $scope.blood_groups = respData.blood_groups;
    $scope.student = respData.student;
    })
  $scope.updateStudent = function() {
    $scope.submitted = true;
    $scope.msgDisplay = false;
    if(!$scope.editStudent.$valid) {return;}
    $http({
          method: 'POST',
          url: '/api/student/edit/' + $scope.studentId,
          headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
          data: $.param($scope.student)
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
    $scope.student= {};
    $scope.editStudent.$setPristine();
  }

  $scope.hasError = function(field, validation){
    if(validation){
      return ($scope.editStudent[field].$dirty && $scope.editStudent[field].$error[validation]) || ($scope.submitted && $scope.editStudent[field].$error[validation]);
    }
    return ($scope.editStudent[field].$dirty && $scope.editStudent[field].$invalid) || ($scope.submitted && $scope.editStudent[field].$invalid);
  };
})
.controller('ListStudentController', function ($scope, $http, $window) {
  console.log("List Student Controller  new reporting for duty.");
  $scope.searchFilter = {};
  $scope.students = {};
  $http.get("/api/student/list").then(function(response) {
    $scope.students = response.data.students;
     $scope.searchFilter = response.data.filters;    
    })  

  $scope.filterBy = function(open) {
    $scope.opFilter = open;
    console.log('Dropdown is now: ', open);
  };
})
.controller('StudentDetailsController', function ($scope, $http, $window) {
  console.log("Details Student Controller  new reporting for duty.");
  $scope.student = {};
  $http.get("/api/student/details/" + $scope.studentId).then(function(response) {
    $scope.student = response.data.student;
        
    })  
})
;
