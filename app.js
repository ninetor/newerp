'use strict';
// adjust to the your url of web service
var serviceBase = 'http://erp-server.local/'
// declare app level module which depends on views, and components
var spaApp = angular.module('ERP', [
    'ngRoute',
    'ERP.site',
]);
// sub module declaration
var spaApp_site = angular.module('ERP.site', ['ngRoute']);

spaApp.config(['$routeProvider', function($routeProvider) {
    // config default route
    $routeProvider.otherwise({redirectTo: '/site/index'});
}]);