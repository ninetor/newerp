'use strict';
userModule.factory("services", ['$http','$location','$route',
    function($http,$location,$route) {
        var obj = {};
        obj.getUsers = function(){
            return $http.get(serviceBase + 'users');
        };
        obj.createUser = function (user) {
            return $http.post( serviceBase + 'users', user )
                .then( successHandler )
                .catch( errorHandler );
            function successHandler( result ) {
                $location.path('/users/index');
            }
            function errorHandler( result ){
                console.log(result);
                $location.path('/users/create')
            }
        };
        obj.getUser = function(userID){
            return $http.get(serviceBase + 'users/' + userID);
        };

        obj.updateUser = function (user) {
            return $http.put(serviceBase + 'users/' + user.id, user )
                .then( successHandler )
                .catch( errorHandler );
            function successHandler( result ) {
                $location.path('/users/index');
            }
            function errorHandler( result ){
                alert("Error data");
                $location.path('/users/update/' + users.id)
            }
        };
        obj.deleteUser = function (userID) {
            return $http.delete(serviceBase + 'users/' + userID)
                .then( successHandler )
                .catch( errorHandler );
            function successHandler( result ) {
                $route.reload();
            }
            function errorHandler( result ){
                alert("Error data");
                $route.reload();
            }
        };
        return obj;
    }]);