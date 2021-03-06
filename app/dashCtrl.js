app.controller('dashCtrl', function ($scope, $rootScope, Data, $state){
	Data.get('session').then(function (results) {
		$rootScope.authenticated = false;
		if (results.uid) {
			$rootScope.authenticated = true;
			$rootScope.uid = results.uid;
			$rootScope.name = results.name;
			$rootScope.email = results.email;
		}
		if(!$rootScope.authenticated){
			$state.go('login');
		} 
	});
	$scope.logout = function () {
		Data.get('logout').then(function (results) {
			Data.toast(results);
            $rootScope.authenticated = false;
            $state.go('login');
        });
	}

});