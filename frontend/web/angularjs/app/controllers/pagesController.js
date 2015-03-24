app.controller('indexCtrl', function ($rootScope, $scope) {
    $rootScope.baseUrl = _yii_app.baseUrl;
    $rootScope.layoutPath = _yii_app.layoutPath;

    $rootScope.bodyClass = 'short_main';
    $scope.params = {};


});

app.controller('CustomOrderCtrl', function ($rootScope, $scope, $modal, $filter, ssHelper) {

    $rootScope.baseUrl = _yii_app.baseUrl;
    $rootScope.layoutPath = _yii_app.layoutPath;
    $rootScope.bodyClass = '';

    $scope.info = {};
    $scope.level = {};


    ssHelper.get("/page/customorder").then(function(response){
        $scope.info = response.data;

    });

    $scope.getMemberLevelInfo = function(level_id){
        var f = _.findWhere($scope.info.allSubscription, {id: level_id});
        if(typeof f !== 'undefined'){
            $scope.level = f;
        }
    }

    $scope.changeMemberLevel = function(){
        var f = _.findWhere($scope.info.allSubscription, {id: $scope.level_id});
        if(typeof f !== 'undefined'){
            $scope.level = f;
        }
    }


});
