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
        templateUrl : 'partials/login.php',
        controller: 'authCtrl'
    
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
        templateUrl: "partials/login.php",
        controller: 'authCtrl'
    })
});
    // .run(function ($rootScope, $location, Data) {
    //     console.log('beginning');
    //     $rootScope.$on("$routeChangeStart", function (event, next, current) {
    //         console.log('second');
    //         $rootScope.authenticated = false;
    //         Data.get('session').then(function (results) {
    //             console.log('middle');
    //             if (results.uid) {
    //                 console.log('inside middle');
    //                 $rootScope.authenticated = true;
    //                 $rootScope.uid = results.uid;
    //                 $rootScope.name = results.name;
    //                 $rootScope.email = results.email;
    //             } 
    //         });
    //     });
    // });

    // IMPLEMENT THE LOGIN WITH REMEMBER ME COOKIE !!!!!!!! FIRST SET THE COOKIE WITH REMEMBERIDENTIFIER__REMEMBERTOKEN and save the REMEMBERIDENTIFIER and REMEMBERTOKEN in the database
    // then after you reopen the browser check for the REMEMBERIDENTIFIER_REMEMBERTOKEN cookie and if it exist check in the database if there is a REMEMBERIDENTIFIER and REMEMBERTOKEN with the same values
    // if there is a match login a user with the id which has the REMEMBERMETOKEN and REMEMBERMEIDENTIFIER