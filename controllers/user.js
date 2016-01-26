'use strict';
userModule.config(['$routeProvider', function($routeProvider) {
    $routeProvider
        .when('/users', {
            templateUrl: 'views/user/index.html',
            controller: 'index'
        })
        .when('/users/create', {
            templateUrl: 'views/user/create.html',
            controller: 'create',
            resolve: {
                user: function(services, $route){
                    return services.getUsers();
                }
            }
        })
        .when('/users/update/:userId', {
            templateUrl: 'views/user/update.html',
            controller: 'update',
            resolve: {
                user: function(services, $route){
                    var userId = $route.current.params.userId;
                    return services.getUser(userId);
                }
            }
        })
        .when('/users/delete/:userId', {
            templateUrl: 'views/user/index.html',
            controller: 'delete',
        })
        .otherwise({
            redirectTo: '/users'
        });
}]);

userModule.controller('index', ['$scope', '$http', 'services',
    function($scope,$http,services) {
        $scope.message = 'Everyone come and see how good I look!';
        services.getUsers().then(function(data){
            $scope.users = data.data;
        });
        $scope.deleteUser = function(userID) {
            if(confirm("Are you sure to delete user number: " + userID)==true && userID>0){
                services.deleteUser(userID);
                $route.reload();
            }
        };
    }])
    .controller('create', ['$scope', '$http', 'services','$location','user',
        function($scope,$http,services,$location,user) {
            //$scope.message = 'Look! I am an about page.';
            $scope.user = user;
            $scope.createUser = function(user) {
                var results = services.createUser(user);
            };
            $http.get(serviceBase + 'user/get-branches', {
                withCredentials: true
            }).then(function (response) {
                $scope.branches = response.data.items;
            });

        }])
    .controller('update', ['$scope', '$http', '$routeParams', 'services','$location','user',
        function($scope,$http,$routeParams,services,$location,user) {
            var original = user.data;
            $scope.user = angular.copy(original);
            $scope.isClean = function() {
                return angular.equals(original, $scope.user);
            }
            $scope.updateUser = function(user) {
                var results = services.updateUser(user);
            }
        }]);