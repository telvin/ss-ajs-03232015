var queryStrings = getQueryStrings();
var prev_r = decodeURIComponent(queryStrings['prev_r']);
var qtrings = "";
var whichOs = "";
var whichBrowser = "";

if (navigator.appVersion.indexOf("Win")!=-1) whichOS="Windows";
else if (navigator.appVersion.indexOf("Mac")!=-1) whichOS="MacOS";
else if (navigator.appVersion.indexOf("X11")!=-1) whichOS="UNIX";
else if (navigator.appVersion.indexOf("Linux")!=-1) whichOS="Linux";

navigator.sayswho= (function(){
    var ua= navigator.userAgent, tem,
        M= ua.match(/(opera|chrome|safari|firefox|msie|trident(?=\/))\/?\s*(\d+)/i) || [];
    if(/trident/i.test(M[1])){
        tem=  /\brv[ :]+(\d+)/g.exec(ua) || [];
        return 'IE '+(tem[1] || '');
    }
    if(M[1]=== 'Chrome'){
        tem= ua.match(/\bOPR\/(\d+)/)
        if(tem!= null) return 'Opera '+tem[1];
    }

    M= M[2]? [M[1], M[2]]: [navigator.appName, navigator.appVersion, '-?'];
    /*
     if((tem= ua.match(/version\/(\d+)/i))!= null) M.splice(1, 1, tem[1]);
     return M.join('_');
     */

    return M[0];

})();
whichBrowser = navigator.sayswho;

$.each( queryStrings, function( index, key ) {
    if(key!='prev_r')
        qtrings += key+"="+ queryStrings[key] +"&";
});

var prevUrl = yii.urls.pureUrl +  prev_r + '?' +qtrings;

function buildUrlFromExistQueryString(router, modifyQueryStrings, currentQueryStrings){
    currentQueryStrings = typeof currentQueryStrings !== 'undefined' ? currentQueryStrings : queryStrings;

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

    return (yii.urls.pureUrl +  router + '?' +Qstrings);
}

function isNumber(n) {
    return !isNaN(parseFloat(n)) && isFinite(n);
}

//include detecting id from url that has been rewrote, url could be undefined
function getQueryStrings(url)
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
    if(isNumber(queyrystring_id)){
        vars.push('id');
        vars['id'] = queyrystring_id;
    }


    return vars;
}


String.format = function() {
    var s = arguments[0];
    for (var i = 0; i < arguments.length - 1; i++) {
        var reg = new RegExp("\\{" + i + "\\}", "gm");
        s = s.replace(reg, arguments[i + 1]);
    }

    return s;
}

function openWindowUrl(url, w, h, scrollbars, toolbar, location,  status, menubar, resizeable){
    var is_chrome = navigator.userAgent.indexOf('Chrome') > -1;
    var is_explorer = navigator.userAgent.indexOf('MSIE') > -1;
    var is_firefox = navigator.userAgent.indexOf('Firefox') > -1;
    var is_safari = navigator.userAgent.indexOf("Safari") > -1;
    var is_Opera = navigator.userAgent.indexOf("Presto") > -1;
    if ((is_chrome)&&(is_safari)) {is_safari=false;}
    var is_safari_only = navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1;

    toolbar = typeof toolbar === 'undefined' ? '0' : toolbar;
    location = typeof location === 'undefined' ? '0' : location;
    status = typeof status === 'undefined' ? '0' : status;
    menubar = typeof menubar === 'undefined' ? '0' : menubar;
    scrollbars = typeof scrollbars === 'undefined' ? '0' : scrollbars;
    resizeable = typeof resizeable === 'undefined' ? '0' : resizeable;
    //console.log('toolbar='+toolbar+',location='+location+',status='+status+',menubar='+menubar+',scrollbars='+scrollbars+',resizable='+resizeable+',width='+w+',height='+h);

    if(is_safari_only){

        //$.scrollbarWidth=function(){var a,b,c;if(c===undefined){a=$('<div style="width:50px;height:50px;overflow:auto"><div/></div>').appendTo('body');b=a.children();c=b.innerWidth()-b.height(99).innerWidth();a.remove()}return c};
        //console.log($.scrollbarWidth());
        //console.log(window.screenX);
        //console.log(window.screenTop);
    }
    window.open(url,'targetWindow','toolbar='+toolbar+',location='+location+',status='+status+',menubar='+menubar+',scrollbars='+scrollbars+',resizable='+resizeable+',width='+w+',height='+h);
    return false;
}

String.unique = String.guid = String.uid = String.uuid = function(){
    var idx = [], itoh = '0123456789ABCDEF'.split('');

    // Array of digits in UUID (32 digits + 4 dashes)
    for (var i = 0; i< 36; i++) {
        idx[i] = 0xf;
        Math.random() * 0x10; }
    // Conform to RFC 4122, section 4.4
    idx[14] = 4; // version
    idx[19] = (idx[19] & 0x3) | 0x8; // high bits of clock sequence

    // Convert to hex chars
    for (var i = 0; i < 36; i++) { idx[i] = itoh[idx[i]]; }

    // Insert dashes
    idx[8] = idx[13] = idx[18] = idx[23] = '_';

    return idx.join('');
}

/* move position of element in array (reposition)
* Example code: [1, 2, 3].move(0, 1) gives [2, 1, 3].
* */
Array.prototype.move = function (old_index, new_index) {
    if (new_index >= this.length) {
        var k = new_index - this.length;
        while ((k--) + 1) {
            this.push(undefined);
        }
    }
    this.splice(new_index, 0, this.splice(old_index, 1)[0]);
    return this; // for testing purposes
};

function findValueInObject(obj, key, val) {
    var objects = [];
    for (var i in obj) {
        if (!obj.hasOwnProperty(i)) continue;
        if (typeof obj[i] == 'object') {
            objects = objects.concat(findValueInObject(obj[i], key, val));
        } else if (i == key && obj[key] == val) {
            objects.push(obj);
        }
    }
    return objects;
}


$.fn.serializeObject = function()
{
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};

function isFunction(functionToCheck) {
    var getType = {};
    return functionToCheck && getType.toString.call(functionToCheck) === '[object Function]';
}


/**
 *
 * run the impromtu popup with the sequences
 * the template will be defined such as (1)
 * @param sequences_name
 */

/* DEFAULT template
var sequences_name = "screensSkeleton";
window[sequences_name] = [
    {
        name: 'step1',
        content_selector: '#hd_body_id_1',
        buttons: [
            {bid: 1, name: 'btn1', function: func_step01_01, jumpTo: ''},
            {bid: 2, name: 'btn2', function: func_step01_02, jumpTo: 'step2'},
            {bid: 3, name: 'btn3', function: func_step01_03, jumpTo: '' , close: 1}
        ]
    },

    {
        name: 'step2',
        content_selector: '#hd_body_id_2',
        buttons: [
            {bid: 4, name: 'btn1', function: func_step02_01, jumpTo: 'step1'},
            {bid: 5, name: 'btn2', function: func_step02_02, jumpTo: ''},
            {bid: 6, name: 'btn3', function: func_step02_03, jumpTo: ''}
        ]
    }

];
*/

function runPopupWithSequence(sequences_name,options){
    if(typeof option == "undefined") option = {};
    _map_buttons = {};
    impromtuSetup = {};

    if(typeof window[sequences_name] === 'undefined'){
        console.log('sequance ' + sequences_name + ' is not defined');
    }
    $.each(window[sequences_name], function (index, item) {

        _buttons = [];
        $.each(item.buttons, function (b_index, b_item) {
            //_buttons[b_item.name] = b_item.bid;
            _buttons.push({ title: b_item.name, value: b_item.bid });
            _map_buttons[b_item.bid] = b_item;
        });

        impromtuSetup[item.name] = {
            html: $(item.content_selector).length > 0 ? $(item.content_selector).html() : item.html,
            focus: 1,
            buttons: _buttons,
            submit: function (e, v, m, f) {

                if(v){
                    e.preventDefault();
                    var btn = _map_buttons[v];
                    if(btn.close == 1){
                        window[sequences_name + '_close']();
                    }else if(btn.self_redirect == 1){
                        window[sequences_name + '_close']();
                        location.reload(false);
                    }
                    else if(typeof btn.jumpTo != "undefined" && btn.jumpTo != ''){
                        $.prompt.goToState(btn.jumpTo);
                        console.log($.prompt.position());
                        return false;
                    }else{
                        var callback = btn.function;
                        var callbackArguments = btn.arguments;

                        if (isFunction(callback)) {
                            //callback.apply(null, Array.prototype.slice.call(callbackArguments));
                            if(typeof callbackArguments !== 'undefined' && callbackArguments.length){
                                callback.apply(null, Array.prototype.slice.call(callbackArguments));
                            }
                            else
                                callback();
                        }
                    }
                }
            }
        }
    });


    function dynamicCallback (func){
        this[func].apply(this, Array.prototype.slice.call(arguments, 1));
    }


    $.each(window[sequences_name], function (index, item) {
        //prepare content
        window['content_' + item.name] = $(item.content_selector).html();
        $(item.content_selector).html('');
    });

    //console.log(JSON.stringify(impromtuSetup));
    var myPrompt = $.prompt(impromtuSetup,$.extend({
        promptspeed: 'fast',overlayspeed:'fast'
    },options));

    window[sequences_name + '_close'] = function (){
        $.prompt.close();

        $.each(window[sequences_name], function (index, item) {
            //prepare content
            if(typeof window['content_' + item.name] != "undefined")
                $(item.content_selector)[0].innerHTML = window['content_' + item.name]; // NOTE: don't use the .html() here, it would strip the script tag
        });
    }

    return myPrompt;
}

function twoDigits(d) {
    if(0 <= d && d < 10) return "0" + d.toString();
    if(-10 < d && d < 0) return "-0" + (-1*d).toString();
    return d.toString();
}

function tryParseJSON (jsonString){
    try {
        var o = JSON.parse(jsonString);

        // Handle non-exception-throwing cases:
        // Neither JSON.parse(false) or JSON.parse(1234) throw errors, hence the type-checking,
        // but... JSON.parse(null) returns 'null', and typeof null === "object",
        // so we must check for that, too.
        if (o && typeof o === "object" && o !== null) {
            return o;
        }
    }
    catch (e) { }

    return false;
};

/**
 * convert js date object to datetime format of mysql
 **/
Date.prototype.toMysqlFormat = function() {
    return this.getUTCFullYear() + "-" + twoDigits(1 + this.getUTCMonth()) + "-" + twoDigits(this.getUTCDate()) + " " + twoDigits(this.getUTCHours()) + ":" + twoDigits(this.getUTCMinutes()) + ":" + twoDigits(this.getUTCSeconds());
};

$.fn.extend({
    showLoadingPopup:function(){

        var _imgUrl = yii.urls.baseUrl;
        var jqimessage = $('#jqi > .jqicontainer > #jqistates > div.jqi_state:not(:hidden) > .jqimessage');
        var jqibuttons = $('#jqi > .jqicontainer > #jqistates > div.jqi_state:not(:hidden) > .jqibuttons');

        if(jqimessage.length > 0){
            var _content = jqimessage.html();
            $('body').append('<div id="tempContent">'+_content+'</div>');

            jqimessage.css('text-align','center');
            jqimessage.html('<img class="loading-icon" src="' + _imgUrl + '/themes/sign_smart/images/loading_icon.gif" />');
            jqibuttons.hide();
        }
    },
    hideLoadingPopup:function(){

        var jqimessage = $('#jqi > .jqicontainer > #jqistates > div.jqi_state:not(:hidden) > .jqimessage');
        var jqibuttons = $('#jqi > .jqicontainer > #jqistates > div.jqi_state:not(:hidden) > .jqibuttons');

        if(jqimessage.length > 0){
            var _temp = $('body #tempContent');
            var _content = _temp.html();

            setTimeout(function(){
                jqimessage.html(_content);
                jqibuttons.show();
            },500);

            _temp.remove();
        }
    }
});