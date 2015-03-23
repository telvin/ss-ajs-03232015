app.factory("Data", ['$http', '$q', '$location',
    function ($http, $q, $location) {

        var serviceBase = '../../angularjs/api/v1/'; // example: http://localhost:8081/signsmart_yii2_angularjs/frontend/web/angularjs/api/v1/products

        var obj = {};

        obj.get = function (q) {

            return $http.get(serviceBase + q).then(function (results) {
                return results.data;
            });
        };
        obj.post = function (q, object) {
            return $http.post(serviceBase + q, object).then(function (results) {
                return results.data;
            });
        };
        obj.put = function (q, object) {
            return $http.put(serviceBase + q, object).then(function (results) {
                return results.data;
            });
        };
        obj.delete = function (q) {
            return $http.delete(serviceBase + q).then(function (results) {
                return results.data;
            });
        };
        return obj;
}]);
