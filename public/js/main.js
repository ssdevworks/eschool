/** 
 * Main AngularJS Web Application 
 */ 
var app = angular.module('eSchoolApp', [ 
    'ngRoute',
    'ui.router',
    'ui.bootstrap',
    'ngCookies',  
    'authCtrl',
    'homeCtrl',
    'teacherCtrl',
]);


/** 
 * Configure the Routes 
 */
 
app.config([
    '$routeProvider', 
    '$locationProvider', 
    '$httpProvider',
    '$stateProvider', 
    '$urlRouterProvider',
    function ($routeProvider, $locationProvider, $httpProvider, $stateProvider, $urlRouterProvider) {
        /*
    $routeProvider
    // Home
    .when("/", {templateUrl: "partials/home.html", controller: "AuthController"})
    // Pages
    .when("/login", {templateUrl: "partials/login.html", controller: "AuthController"})
    .when("/signup", {templateUrl: "partials/signup.html", controller: "AuthController"})
    .when("/home", {templateUrl: "partials/dashboard.html", controller: "HomeController"})

    // Blog
    .when("/blog", {templateUrl: "partials/blog.html", controller: "BlogCtrl"})
    .when("/blog/post", {templateUrl: "partials/blog_item.html", controller: "BlogCtrl"})
    // else 404
    .otherwise("/404", {templateUrl: "partials/404.html", controller: "AuthController"});
    */
    $urlRouterProvider.otherwise("/");
    $stateProvider
    .state('/', {
      url: "/",
      templateUrl: "/partials/home.html"
    })
    .state('login', {
      url: "/login",
      access: 'O',
      templateUrl: "/partials/login.html"
    })
    .state('signup', {
      url: "/signup",
      access: 'O',
      templateUrl: "/partials/signup.html"
    })  
    .state('home',{
      url: "/home",
      access: 'O',
      templateUrl: "/partials/dashboard.html"
    })
    .state('teacher', {
    url: '/teacher',
    abstract: true,
    templateUrl: '/partials/teacher.html',
    data : { stateTitle: 'List' }
    /*controller: function($scope){
      $scope.contacts = [{ name: 'Alice' }, { name: 'Bob' }];
    }*/
    })
    .state('teacher.new', {
    url: '/new',
    templateUrl: '/partials/teacher.new.html',
    data : { stateTitle: 'Add New Teacher' }
    })
    .state('teacher.list', {
    url: '',
    templateUrl: '/partials/teacher.list.html',
    data : { stateTitle: 'List Teachers' }
    })
    ;
    
    $locationProvider.html5Mode(true);//.hashPrefix('!');
    var interceptor = ['$location', '$q', function($location, $q) {
        function success(response) {
            return response;
        }

        function error(response) {

            if(response.status === 401) {
                $location.path('/login');
                return $q.reject(response);
            }
            else {
                return $q.reject(response);
            }
        }

        return function(promise) {
            return promise.then(success, error);
        }
    }];

    $httpProvider.responseInterceptors.push(interceptor);
}
])

.run( function($rootScope, $location,$cookieStore,$state, $stateParams, UserInfo) {

$rootScope.$on('$stateChangeStart', 
function(event, toState, toParams, fromState, fromParams){
     if (UserInfo.isLogged === true) {
       if(toState.url === '/'){$state.go("home")}
    }
    $rootScope.$state = $state;
    $rootScope.$stateParams = $stateParams;

    //event.preventDefault(); 
    // transitionTo() promise will be rejected with 
    // a 'transition prevented' error
})

$rootScope.$on('$stateNotFound', 
function(event, unfoundState, fromState, fromParams){ 
    console.log(unfoundState.to); // "lazy.state"
    console.log(unfoundState.toParams); // {a:1, b:2}
    console.log(unfoundState.options); // {inherit:false} + default options
})

 })

 app.directive('script', function() {
    return {
    restrict: 'E',
    scope: false,
    link: function(scope, elem, attr)
    {
    if (attr.type==='text/javascript-lazy')
    {
    var s = document.createElement("script");
    s.type = "text/javascript";
    var src = elem.attr('src');
    if(src!==undefined)
    {
    s.src = src;
    }
    else
    {
    var code = elem.text();
    s.text = code;
    }
    document.head.appendChild(s);
    elem.remove();
    }
    }
    };
}); 


/**
 * Controls the Blog
 */
app.controller('BlogCtrl', function (/* $scope, $location, $http */) {
  console.log("Blog Controller reporting for duty.");
});
