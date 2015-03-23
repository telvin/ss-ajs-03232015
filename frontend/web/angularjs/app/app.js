var app = angular.module('signSmart', ['ngRoute', 'ui.bootstrap', 'ngAnimate']);

app.config(['$routeProvider', '$locationProvider',
    function ($routeProvider, $locationProvider) {
        //console.log($routeProvider, $locationProvider);
        $routeProvider
            .when('/', {
                title: 'Products',
                templateUrl: '../../angularjs/views/partials/products.html',
                controller: 'productsCtrl'
            })
            .when('/ta', {
                title: 'Products',
                templateUrl: '../../angularjs/views/partials/products.html',
                controller: 'productsCtrl'
            })

            .when('/ta1', {
                title: 'Products',
                templateUrl: '../../angularjs/views/partials/products.html',
                controller: 'productsCtrl'
            })
            .otherwise({
                redirectTo: '/'
            });

        //$locationProvider.html5Mode(true);
    }]);

//
//app.run(['$location', function AppRun($location) {
//    debugger; // -->> here i debug the $location object to see what angular see's as URL
//}]);