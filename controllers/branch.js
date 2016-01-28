'use strict';
branchModule.config(['$routeProvider', function($routeProvider) {
    $routeProvider
        .when('/branches', {
            templateUrl: 'views/branch/index.html',
            controller: 'index'
        })
        .otherwise({
            redirectTo: '/branches'
        });
}]);

branchModule.controller('index', ['$scope', '$http', 'branchService',
    function($scope,$http,branchService) {
        branchService.getBranches().then(function(data){
            $scope.branches = data.data;
        });
    }]);