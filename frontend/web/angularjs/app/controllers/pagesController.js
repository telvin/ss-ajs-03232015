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

    $scope.demo_items = ['Button 1', 'Button 2', 'Button 3'];
    $scope.demo2_items = ['Button 1', 'Button 2', 'Button 3'];

    $scope.isShowButtons = function () {
        return $location.path() == '/demo' || $location.path() == '/demo2' ;
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
                demo_items: function () {
                    return $scope.demo_items;
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

app.controller('ModalInstanceCtrl', function ($scope, $modalInstance, demo_items, SignalService) {

    $scope.demo_items = demo_items;
    //$scope.selected = {
    //    item: $scope.demo_items[0]
    //};

    $scope.ok = function () {
        $modalInstance.close($scope.selected.item);
    };

    $scope.cancel = function () {
        $modalInstance.dismiss('cancel');
    };

    $scope.changeImage = function(index){
        var sendData = index;
        //console.log('send signal', sendData); // 'Some data'

        SignalService.broadcast('remoteSignal_changeImage', sendData);
    }

    $scope.changeImageDemo2 = function(index){
        var sendData = index;
        //console.log('send signal', sendData); // 'Some data'

        SignalService.broadcast('remoteSignal_changeImageDemo2', sendData);
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

    SignalService.listen('remoteSignal_changeImage', function(event, data){
        //console.log(event, data); // 'Some data'
        $scope.displayIndex = data;
    });

});

app.controller('Demo2Ctrl', function ($rootScope, $scope, SignalService) {
    $rootScope.baseUrl = _yii_app.baseUrl;
    $rootScope.layoutPath = _yii_app.layoutPath;

    $rootScope.bodyClass = '';

    $scope.images = [
        //_yii_app.layoutPath + '/images/music_magoc.jpg',
        _yii_app.layoutPath + '/images/teamwork1.jpg',
        _yii_app.layoutPath + '/images/music-work-shop.jpg'
    ];

    $scope.displayIndex = 0;


    /* execute the command from the remote */
    //$scope.$on('remoteSignal', function(event, data){
    //
    //    console.log(event, data); // 'Some data'
    //    $scope.displayIndex = data;
    //
    //})

    SignalService.listen('remoteSignal_changeImageDemo2', function(event, data){
        //console.log(event, data); // 'Some data'
        $scope.displayIndex = data;
    });

});