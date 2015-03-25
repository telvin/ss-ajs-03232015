app.controller('IndexCtrl', function ($rootScope, $scope) {
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

app.controller('RemoteModalCtrl', function ($scope, $modal, $log) {

    $scope.items = ['item1', 'item2', 'item3'];
    $scope.obj = {};

    $scope.open = function (size) {
        var modalInstance = $modal.open({
            templateUrl: _yii_app.absTemplatePath + '/partials/modal-content-signup.html',
            windowTemplateUrl: _yii_app.absTemplatePath + '/partials/modal-window-signup.html',
            controller: 'ModalInstanceCtrl',
            windowClass: 'app-modal-window',
            size: size,
            scope: $scope,
            backdrop: false,
            resolve: {
                items: function () {
                    return $scope.items;
                }
            }
        });

        modalInstance.result.then(function (selectedItem) {
            $scope.selected = selectedItem;
        }, function () {
            $log.info('Modal dismissed at: ' + new Date());
        });
    };
});

app.controller('ModalInstanceCtrl', function ($scope, $modalInstance, items) {

    $scope.items = items;
    $scope.selected = {
        item: $scope.items[0]
    };

    $scope.ok = function () {
        $modalInstance.close($scope.selected.item);
    };

    $scope.cancel = function () {
        $modalInstance.dismiss('cancel');
    };

    $scope.changeImage = function(index){
        console.log(index, 'ttt');
        $scope.sign1.displayIndex = index;
    }
});

app.controller('DemoCtrl', function ($rootScope, $scope) {
    $rootScope.baseUrl = _yii_app.baseUrl;
    $rootScope.layoutPath = _yii_app.layoutPath;

    $rootScope.bodyClass = '';
    $scope.sign1 = {};

    $scope.images = [
        _yii_app.layoutPath + '/images/img_kiosk_preview2.jpg',
        _yii_app.layoutPath + '/images/img_kiosk_preview7.jpg',

    ];
    $scope.sign1.displayIndex = 1;


});