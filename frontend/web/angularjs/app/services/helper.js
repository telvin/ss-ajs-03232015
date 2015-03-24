app.factory('ssHelper', function($http, $rootScope, $location) {
    //var _ = $window._; //bind for underscore

    var d = $location.protocol() + "://" + $location.host() + ":" + $location.port();
    //var b = d + '/' + 'signsmart_yii2_angularjs/';

    var obj = {rootUrl: d};

    obj.get = function (q) {
        return $http.get($rootScope.baseUrl + q).then(function (results) {
            //return results.data; (.data is a certain attribute from the array that is returned from response, nothing special)
            return results;
        });
    };

    obj.post = function (q, object) {
        return $http.post($rootScope.baseUrl + q, object).then(function (results) {
            return results;
        });
    };

    obj.post = function (q, object) {
        return $http.post($rootScope.baseUrl + q, object).then(function (results) {
            return results;
        });
    };

    obj.delete = function (q) {
        return $http.delete($rootScope.baseUrl + q).then(function (results) {
            return results;
        });
    };

    obj.getQueryStrings = function(url)
    {
        url = typeof url !== 'undefined' ? url : window.location.href;
        var vars = [], hash;
        var hashes = url.slice(url.indexOf('?') + 1).split('&');

        var anchor = document.createElement('a');
        anchor.href = url;

        var queyrystring_id = anchor.pathname.slice(anchor.pathname.lastIndexOf('/')+1);

        for(var i = 0; i < hashes.length; i++)
        {
            hash = hashes[i].split('=');
            vars.push(hash[0]);
            vars[hash[0]] = hash[1];
        }
        if(_.isNumber(queyrystring_id)){
            vars.push('id');
            vars['id'] = queyrystring_id;
        }


        return vars;
    }

    obj.createUrl = function (router, modifyQueryStrings){
        currentQueryStrings = obj.getQueryStrings(document.URL);

        if(router == ''){
            router = decodeURIComponent(currentQueryStrings['prev_r']);
        }


        var _cQueryStrings = {};
        $.each( currentQueryStrings, function( index, key ) {
            _cQueryStrings[key] = currentQueryStrings[key];
        });

        if(modifyQueryStrings != null){
            $.each( modifyQueryStrings, function( key, value ) {
                _cQueryStrings[key] = value;

            });
        }

        var Qstrings = "";
        var totalKeyInObj = Object.keys(_cQueryStrings).length;
        var index= 1;
        $.each( _cQueryStrings, function( key, value ) {
            //if(key!='prev_r')
            Qstrings += key+"="+ value;

            if (index < totalKeyInObj)
                Qstrings += "&";
            index++;
        });

        return ($rootScope.baseUrl +  router + '?' +Qstrings);
    }


    return obj;
});