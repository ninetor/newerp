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
                user: function(userService, $route){
                    return userService.getUsers();
                }
            }
        })
        .when('/users/update/:userId', {
            templateUrl: 'views/user/update.html',
            controller: 'update',
            resolve: {
                user: function(userService, $route){
                    var userId = $route.current.params.userId;
                    return userService.getUser(userId);
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

userModule.controller('index', ['$scope', '$http', 'userService',
    function($scope,$http,userService) {
        userService.getUsers().then(function(data){
            $scope.users = data.data;
        });
        $scope.deleteUser = function(userID) {
            if(confirm("Вы уверены что хотите удалить: " + userID)==true && userID>0){
                userService.deleteUser(userID);
                $route.reload();
            }
        };
    }])
    .controller('create', ['$scope', '$http', 'userService','$location','user',
        function($scope,$http,userService,$location,user) {
            $scope.user = user;
            $scope.createUser = function(user) {
                var results = userService.createUser(user);
            };

            //get branches to select
            $http.get(serviceBase + 'branches', {  timeout: 600}).
                success(function(data, status, headers, config) {
                    $scope.branches = data;
                });
            //get roles to select
            $http.get(serviceBase + 'users/roles', {  timeout: 600}).
                success(function(data, status, headers, config) {
                    $scope.roles = data;
                });

        }])
    .controller('update', ['$scope', '$http', '$routeParams', 'userService','$location','user',
        function($scope,$http,$routeParams,userService,$location,user) {
            var original = user.data;
            $scope.user = angular.copy(original);
            $scope.isClean = function() {
                return angular.equals(original, $scope.user);
            };
            $scope.updateUser = function(user) {
                var results = userService.updateUser(user);
            }
        }]);