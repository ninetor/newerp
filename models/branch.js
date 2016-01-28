'use strict';
branchModule.factory("branchService", ['$http','$location','$route',
    function($http,$location,$route) {
        var obj = {};
        obj.getBranches = function(){
            return $http.get(serviceBase + 'branches');
        };
        return obj;
    }]);