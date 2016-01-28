'use strict';
// adjust to the your url of web service
var serviceBase = 'http://erp-server.local/'
// declare app level module which depends on views, and components
var ERP = angular.module('ERP', [
    'ngRoute',
    'ERP.main',
    'ERP.branch',
    'ERP.user',
]);
// sub module declaration
var mainModule = angular.module('ERP.main', ['ngRoute']);
var branchModule = angular.module('ERP.branch', ['ngRoute']);
var userModule = angular.module('ERP.user', ['ngRoute','ERP.branch']);

ERP.config(['$routeProvider', function($routeProvider) {
    // config default route
    $routeProvider.otherwise({redirectTo: '/'});
}]);
