app.controller('authCtrl', function ($scope, $rootScope, $location, $http, Data, $stateParams, $state) {
    //initially set those objects to null to avoid undefined error
    $scope.login = {};
    $scope.signup = {};
    console.log('blabla');
    $scope.name = "Vasil";
    console.log($scope.name + ' lalal');
    $scope.doLogin = function (customer) {
        Data.post('login', {
            customer: customer
        }).then(function (results) {
            Data.toast(results);
            if (results.status == "success") {
                console.log(results);
                // $location.path('/dashboard');
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
                // $location.path('/dashboard');
                $state.go('dashboard');
            }
        });
    };
    $scope.logout = function () {
        Data.get('logout').then(function (results) {
            Data.toast(results);
            // $location.path('/login');
            $state.go('login');
        });
    }
});