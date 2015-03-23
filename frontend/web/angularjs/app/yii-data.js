app.factory("Data", ['$http', '$q', '$location' ,'ssHelper',
    function ($http, $q, $location, ssHelper) {
        //var serviceBase = '../../angularjs/api/v1/';
        //var serviceBase = '../../../../api/web/v1/products/search';
        //var serviceBase = '../../../../api/web/v1/'; // example: http://localhost:8081/signsmart_yii2_angularjs/api/web/v1/products

        var serviceBase = ssHelper.baseUrl + 'api/web/v1/'; // 'http://localhost:8081/signsmart_yii2_angularjs/api/web/v1/'

        var obj = {};
        console.log($location.protocol() + "://" + $location.host() + ":" + $location.port());

        obj.get = function (q) {
            return $http.get(serviceBase + q).then(function (results) {
                //return results.data; (.data is a certain attribute from the array that is returned from response, nothing special)
                return results;
            });
        };
        obj.post = function (q, object) {
            return $http.post(serviceBase + q, object).then(function (results) {
                return results;
            });
        };
        obj.put = function (q, object) {
            return $http.put(serviceBase + q, object).then(function (results) {
                return results;
            });
        };
        obj.delete = function (q) {
            return $http.delete(serviceBase + q).then(function (results) {
                return results;
            });
        };
        return obj;
}]);
