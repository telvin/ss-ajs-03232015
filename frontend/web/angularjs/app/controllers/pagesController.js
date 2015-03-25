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

/** for the remote functionality, we have to make the remote that is able to control every screen, therefore
 * I keep modal controller as top parent scope to any children scope **/
app.controller('RemoteModalCtrl', function ($scope, $modal, $location, $route, $log) {

    $scope.items = ['Button 1', 'Button 2', 'Button 3'];

    $scope.isShowButtons = function () {
        return $location.path() == '/demo';
    };


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

app.controller('ModalInstanceCtrl', function ($scope, $modalInstance, items, SignalService) {

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
        var sendData = index;
        //console.log('send signal', sendData); // 'Some data'

        SignalService.broadcast('remoteSignal', sendData);
    }
});

app.controller('DemoCtrl', function ($rootScope, $scope, SignalService) {
    $rootScope.baseUrl = _yii_app.baseUrl;
    $rootScope.layoutPath = _yii_app.layoutPath;

    $rootScope.bodyClass = '';

    $scope.images = [
        _yii_app.layoutPath + '/images/lotus-c-01-motorcycle-116.jpg',
        _yii_app.layoutPath + '/images/motorcycle-raid.jpg',
        _yii_app.layoutPath + '/images/business_people_2.png',


    ];
    $scope.displayIndex = 0;


    /* execute the command from the remote */
    //$scope.$on('remoteSignal', function(event, data){
    //
    //    console.log(event, data); // 'Some data'
    //    $scope.displayIndex = data;
    //
    //})

    SignalService.listen('remoteSignal', function(event, data){
        //console.log(event, data); // 'Some data'
        $scope.displayIndex = data;
    });


});