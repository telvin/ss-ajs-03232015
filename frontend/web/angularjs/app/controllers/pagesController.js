app.controller('indexCtrl', function ($rootScope, $scope) {
    $rootScope.bodyClass = 'short_main';

    $scope.params = {};


});

app.controller('CustomOrderCtrl', function ($rootScope, $scope, $modal, $filter, ssHelper) {

    $rootScope.baseUrl = _yii_app.baseUrl;
    $rootScope.layoutPath = _yii_app.layoutPath;

    $scope.info = {};

    ssHelper.get("page/customorder").then(function(data){
        $scope.info = data;

    });


});
