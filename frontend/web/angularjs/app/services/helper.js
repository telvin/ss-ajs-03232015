app.factory("ssHelper", ['$location', function($location){
    var d = $location.protocol() + "://" + $location.host() + ":" + $location.port();
    var b = d + '/' + 'signsmart_yii2_angularjs/';
    return {
        domain: d,
        baseUrl: b
    };
}]);
