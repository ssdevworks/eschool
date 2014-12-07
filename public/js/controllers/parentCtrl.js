angular.module('parentCtrl', [])

.controller('AddParentController', function ($scope, $http, $window) {
  console.log("parent Controller  new reporting for duty.");
  $scope.parent = {};
  $scope.submitted = false;
  $http.get("/api/parent/new").then(function(response) {
  	var respData = response.data;
    $scope.students = respData.students;
    $scope.relations = respData.relations;       
    })
  $scope.addNewParent = function() {
    $scope.submitted = true;
    $scope.msgDisplay = false;
    if(!$scope.addParent.$valid) {return;}
    $http({
          method: 'POST',
          url: '/api/parent/new',
          headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
          data: $.param($scope.parent)
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
    $scope.parent= {};
    $scope.addParent.$setPristine();
  }

  $scope.hasError = function(field, validation){
    if(validation){
      return ($scope.addParent[field].$dirty && $scope.addParent[field].$error[validation]) || ($scope.submitted && $scope.addParent[field].$error[validation]);
    }
    return ($scope.addParent[field].$dirty && $scope.addParent[field].$invalid) || ($scope.submitted && $scope.addParent[field].$invalid);
  };
})
.controller('EditParentController', function ($scope, $http, $window) {
  console.log("Edit Parent Controller reporting for duty.");
  console.log('parent id =>' + $scope.parentId);
  $scope.parent = {};
  $scope.submitted = false;
  $http.get("/api/parent/edit/" + $scope.parentId).then(function(response) {
    var respData = response.data;
    $scope.students = respData.students;
    $scope.relations = respData.relations;   
    $scope.parent = respData.parent;
    })
  $scope.updateParent = function() {
    $scope.submitted = true;
    $scope.msgDisplay = false;
    if(!$scope.editParent.$valid) {return;}
    $http({
          method: 'POST',
          url: '/api/parent/edit/' + $scope.parentId,
          headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
          data: $.param($scope.parent)
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
    $scope.parent= {};
    $scope.editParent.$setPristine();
  }

  $scope.hasError = function(field, validation){
    if(validation){
      return ($scope.editParent[field].$dirty && $scope.editParent[field].$error[validation]) || ($scope.submitted && $scope.editParent[field].$error[validation]);
    }
    return ($scope.editParent[field].$dirty && $scope.editParent[field].$invalid) || ($scope.submitted && $scope.editParent[field].$invalid);
  };
})
.controller('ListParentController', function ($scope, $http, $window) {
  console.log("List Parent Controller  new reporting for duty.");
  $scope.searchFilter = {};
  $scope.parents = {};
  $http.get("/api/parent/list").then(function(response) {
    $scope.parents = response.data.parents;
  })  

  })
.controller('ParentDetailsController', function ($scope, $http, $window) {
  console.log("Details Parent Controller  new reporting for duty.");
  $scope.parent = {};
  $http.get("/api/parent/details/" + $scope.parentId).then(function(response) {
    $scope.parent = response.data.parent;
        
    })  
})
;
