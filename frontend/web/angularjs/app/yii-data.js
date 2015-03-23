app.factory("Data", ['$http', '$q', '$location' ,'ssHelper',
    function ($http, $q, $location, ssHelper) {
        var serviceBase = ssHelper.baseUrl + 'frontend/web/'; // 'http://localhost:8081/signsmart_yii2_angularjs/frontend/web/'

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
