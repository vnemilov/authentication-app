app.controller('authCtrl', function ($scope, $rootScope, $location, $http, Data, $stateParams, $state) {
    //initially set those objects to null to avoid undefined error
    $scope.login = {};
    $scope.signup = {};

    $scope.name = "Vasil";

    $scope.doLogin = function (customer) {
        Data.post('login', {
            customer: customer
        }).then(function (results) {
            Data.toast(results);
            if (results.status == "success") {
                console.log(results.rememberinfo);
                console.log(results);
                $rootScope.test = 5;
                console.log($scope.name);
                $state.go('dashboard');
            }
        });
    };
    $scope.signup = {email:'',password:'',name:'',phone:'',address:''};
    $scope.signUp = function (customer) {
        Data.post('signUp', {
            customer: customer
        }).then(function (results) {
            Data.toast(results);
            if (results.status == "success") {
                $state.go('dashboard');
            }
        });
    };
});