var app =  angular.module('main-App',['ngRoute','angularUtils.directives.dirPagination']);

app.config(['$routeProvider',

    function($routeProvider) {

        $routeProvider.

            when('/storeprofile', {

                templateUrl: 'templates/home.html',

                controller: 'AdminController'

            }).

            when('/itemss', {

                templateUrl: 'templates/items.html',

                controller: 'ItemController'

            });

}]);