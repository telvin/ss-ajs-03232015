app.config(['$routeProvider', '$locationProvider',
    function ($routeProvider, $locationProvider) {
        //console.log($routeProvider, $locationProvider);
        $routeProvider
            .when('/', {
                templateUrl: _yii_app.templatePath + '/pages/index.html',
                controller: 'IndexCtrl',
                css: '../../angularjs/css/ss/css/screen.css'
            })
            .when('/customorder', {
                templateUrl: _yii_app.templatePath + '/pages/custom-order.html',
                controller: 'CustomOrderCtrl',
                css: [
                    '../../angularjs/css/ss/css/screen.css',
                    '../../angularjs/css/ss/css/new_content_database.css',
                    '../../angularjs/css/ss/css/addcontent121212.css',
                ]
            })

            .when('/demo', {
                templateUrl: _yii_app.templatePath + '/pages/demo.html',
                controller: 'DemoCtrl',
                css: [
                    '../../angularjs/css/ss/css/screen.css',
                    '../../angularjs/css/ss/css/new_content_database.css',
                    '../../angularjs/css/ss/css/addcontent121212.css',
                ]
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