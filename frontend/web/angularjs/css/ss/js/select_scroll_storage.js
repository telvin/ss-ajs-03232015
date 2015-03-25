var safari = navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1;
$(document).ready(function(){
    $(".chzn-select").chosen().change(function(){
        $('.handle').css('height','auto');
        setTimeout(function () {
            //if(typeof(myScroll) != 'undefined')
                myScroll.refresh();
        }, 0);
    });
});

var myScroll;
function loaded() {
    //if(!safari)
        myScroll = new iScroll('newScroll', { scrollbarClass: 'myScrollbar',vScrollbar: false  });
}

document.addEventListener('touchmove', function (e) { e.preventDefault(); }, false);
document.addEventListener('DOMContentLoaded', function () { setTimeout(loaded, 200); }, false);

$(window).bind("mouseenter", function() {
    $('a.chzn-single').click(function(){
        $('.handle').css('height','700px');
        setTimeout(function () {
            //if(typeof(myScroll) != 'undefined')
                myScroll.refresh();
        }, 0);
    });
    $('.add').click(function(){
        setTimeout(function () {
            if(typeof(myScroll) != 'undefined')
                myScroll.refresh();
        }, 0);
    });
    $('.remove_field').click(function(){
        setTimeout(function () {
            //if(typeof(myScroll) != 'undefined')
                myScroll.refresh();
        }, 0);
    });
});
var $box = $('.chzn-drop');
$(document.body).click(function(){
    if (!$box.has(this).length) {
        $('.handle').css('height','auto');
        setTimeout(function () {
            myScroll.refresh();
        }, 0);
    }
});

$("input.inputbox").bind('click', function (e) {
    e.preventDefault();
    e.bubble = false;
    return false;
}).bind('focus', function (e) {
        e.preventDefault();
        e.bubble = false;
        myScroll.destroy();
    }).bind('blur', loaded);

