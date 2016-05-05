app.controller('dashCtrl', function ($scope, $rootScope, Data, $state){

$scope.yolo = "YOLO BITCHEZ";
$scope.rtest = $rootScope.test;
if($scope.rtest != 5){
	$state.go('login');
}
    $scope.logout = function () {
        Data.get('logout').then(function (results) {
            Data.toast(results);
            // $location.path('/login');
            $scope.rtest = 0;
            $state.go('login');
        });
    }

});