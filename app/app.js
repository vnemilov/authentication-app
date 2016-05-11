var app = angular.module('app', ['ui.router', 'ngAnimate', 'toaster']);

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