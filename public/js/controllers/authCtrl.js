	// public/js/controllers/authCtrl.js
	angular.module('authCtrl', [])

.controller('AuthController', function ($scope, $http, $window,$cookieStore) {
  console.log("Page Controller  new reporting for duty.");

 // creating a blank object to hold our form information.
  //$scope will allow this to pass between controller and view
  $scope.formData = {};
  // submission message doesn't show when page loads
  $scope.submission = false;
  
    $scope.submitLoginForm = function() {
    $http({
    method : 'POST',
    url : '/api/login',
    data : $.param($scope.formData), // pass in data as strings
    headers : { 'Content-Type': 'application/x-www-form-urlencoded' } // set the headers so angular passing info as form data (not request payload)
  })
    .success(function(data) {
      if (!data.success) {
       $scope.submissionMessage = data.message;
       $scope.submission = true; //shows the error message
       $cookieStore.put('user_auth','N');
      } else {
      // if successful, bind success message to message
       $scope.submissionMessage = data.message;
       $scope.formData = {}; // form fields are emptied with this line
       $scope.submission = true; //shows the success message
       $cookieStore.put('user_auth','Y');
       $cookieStore.put('user_name',data.user_name);
       $cookieStore.put('user_type','P');
       $cookieStore.put('user_access','3');
       $window.location.href = 'home';
      }
     });
   };
   $scope.logout = function() {
      $cookieStore.remove('user_auth');
      $cookieStore.remove('user_name');
      $cookieStore.remove('user_type');
      $cookieStore.remove('user_access');        
      $window.location.href = '/logout'; 

   }

 
})
.factory('UserInfo', ['$cookieStore', function($cookieStore) {
    var sdo = {
    isLogged: $cookieStore.get('user_auth') === 'Y' ? true : false,
    username: $cookieStore.get('user_name'),
    usertype: $cookieStore.get('user_type'),     
    useraccess: $cookieStore.get('user_access'), 
  };
  return sdo;
 }]);
;
