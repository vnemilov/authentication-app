var app = angular.module('app', ['ui.router', 'ngAnimate', 'toaster']);

// app.config(['$routeProvider',
//   function ($routeProvider) {
//         $routeProvider.
//         when('/login', {
//             title: 'Login',
//             templateUrl: 'partials/login.html',
//             controller: 'authCtrl'
//         })
//             .when('/logout', {
//                 title: 'Logout',
//                 templateUrl: 'partials/login.html',
//                 controller: 'logoutCtrl'
//             })
//             .when('/signup', {
//                 title: 'Signup',
//                 templateUrl: 'partials/signup.html',
//                 controller: 'authCtrl'
//             })
//             .when('/dashboard', {
//                 title: 'Dashboard',
//                 templateUrl: 'partials/dashboard.html',
//                 controller: 'authCtrl'
//             })
//             .when('/', {
//                 title: 'Login',
//                 templateUrl: 'partials/login.html',
//                 controller: 'authCtrl',
//                 role: '0'
//             })
//             .otherwise({
//                 redirectTo: '/login'
//             });
//   }])



app.config(function($stateProvider, $urlRouterProvider) {

    $urlRouterProvider.otherwise('/login');

    $stateProvider

    // STATES
    .state('login', {
        url : '/login',
        title: 'Login',
        templateUrl : 'partials/login.html',
        controller: 'authCtrl'
    }).state('logout', {
        url : '/logout',
        title: 'Logout',
        templateUrl : 'partials/login.html',
        controller : 'logoutCtrl'
    }).state('signup', {
        url : '/signup',
        title: 'Signup',
        templateUrl : 'partials/signup.html',
        controller : 'authCtrl'
    }).state('dashboard', {
        url : '/dashboard',
        title: 'Dashboard',
        templateUrl : 'partials/dashboard.php',
        controller : 'dashCtrl'
    }).state('/',{
        url:'/',
        title: 'Login',
        templateUrl: "partials/login.html",
        controller: 'authCtrl'
    })
});
    // .run(function ($rootScope, $location, Data) {
    //     $rootScope.$on("$routeChangeStart", function (event, next, current) {
    //         $rootScope.authenticated = false;
    //         Data.get('session').then(function (results) {
    //             if (results.uid) {
    //                 $rootScope.authenticated = true;
    //                 $rootScope.uid = results.uid;
    //                 $rootScope.name = results.name;
    //                 $rootScope.email = results.email;
    //             } 
    //         });
    //     });
    // });