$(document).ready(function () {
    $('.short input').each(function (index, element) {
        if ($.trim($(this).val()) == '') {
            $(this).prev('.placeholder').show();
        }
        $(this).prev('.placeholder').click(function () {
            $(this).hide();
            $(this).next('input').focus();
        });
        $(this).blur(function () {
            if ($.trim($(this).val()) == '') {
                $(this).prev('.placeholder').show();
            }
        });
        $(this).focus(function () {
            $(this).prev('.placeholder').hide();
        });
    });
    $('.long input').each(function (index, element) {
        if ($.trim($(this).val()) == '') {
            $(this).prev('.placeholder').show();
        }
        $(this).prev('.placeholder').click(function () {
            $(this).hide();
            $(this).next('input').focus();
        });
        $(this).blur(function () {
            if ($.trim($(this).val()) == '') {
                $(this).prev('.placeholder').show();
            }
        });
        $(this).focus(function () {
            $(this).prev('.placeholder').hide();
        });
    });
    $('.inputbox').each(function (index, element) {
        $(this).click(function () {
            $(this).focus();
        });
    });
    $('.forPlaceholder input').each(function (index, element) {
        if ($.trim($(this).val()) == '') {
            $(this).prev('.placeholder').show();
        }
        $(this).prev('.placeholder').click(function () {
            $(this).hide();
            $(this).next('input').focus();
        });
        $(this).blur(function () {
            if ($.trim($(this).val()) == '') {
                $(this).prev('.placeholder').show();
            }
        });
        $(this).focus(function () {
            $(this).prev('.placeholder').hide();
        });
    });
    $('.checkboxStyle').each(function (index, element) {
        $(this).click(function () {
			if(!($(this).hasClass('readonly'))){
				if($(this).hasClass('group')){
					$(this).parents('.checkGroupWrap').find('div.checkboxStyle').removeClass('checked');
					$(this).parents('.checkGroupWrap').find('input').removeAttr('checked');
					$(this).addClass('checked');
					$('input', this).attr('checked', 'checked');
				}else{
					$(this).toggleClass('checked');
				}
				if ($(this).hasClass('checked')) {
					$('input', this).attr('checked', 'checked');
				} else {
					$('input',this).removeAttr('checked');
				}
			}
        });
    });
    $('input.addfile').each(function (index, element) {
        $(this).css('opacity', 0);
    });
    /* select box */
    $('.selectBox').each(function (index, element) {
        var checkHeight = $('.selected', this).height();
        var defaultVar = $('select', this).text();
        $('.selected', this).text(defaultVar);
        $('.selected', this).addClass('defaultText');
        $('ul', this).css('top', checkHeight);
        $('.selected', this).click(function () {
            $(this).next('ul').toggle();
        });
        $('ul li', this).click(function () {
            var getText = $(this).text();
            var myValue = $(this).attr('lang');
            $(this).parents('.selectBox').find('option').text(getText);
            $(this).parents('.selectBox').find('option').val(myValue);
            $(this).parents('.selectBox').find('.selected').text(getText);
            $(this).parents('.selectBox').find('.selected').removeClass('defaultText');
            $(this).parent('ul').hide();
        });
    });
    $('.textareaURL').focus(function () {
        var mytext = $(this).text();
        if (mytext == "Enter Whitelist Domain’s Here") {
            $(this).text('');
        }
    });
    $('.textareaURL').blur(function () {
        var mytext = $(this).text();
        if ($.trim(mytext) == "") {
            $(this).text('Enter Whitelist Domain’s Here');
        }
    });
});
function focusInput(e){
    $(e).focus();
}
function isValidEmail(txtEmail){
    var filter = /^((\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*?)\s*;?\s*)+/;
    if(filter.test(txtEmail)){
        return true;
    }
    else{
        return false;
    }
}
function formRequired(formID,defaultURL){
	var msg = '';
	var error = 0;
	$(formID+' label.required').each(function(index, element) {
		var isRequireEmail = 0;
		var inputID = $(this).attr('for');
		var text = $(this).text();
		var inputVal = $.trim($(formID+' #'+inputID).val());
		if($(formID+' #'+inputID).hasClass('emailrequired')){
			isRequireEmail = 1;
		}
        if($.trim($(formID+' #'+inputID).val())==''){
			if(inputID == 'Kiosk_support_email'){
				msg = msg + text.replace("*","") + ' address is required.' + "<br />";
			}else{
				msg = msg + text.replace("*","") + ' is required.' + "<br />";
			}
			error = error + 1;
		}
		if(inputVal != '' && isRequireEmail ==1 && (isValidEmail(inputVal) == false)){
			msg = msg + text.replace("*","") + ' address is invalid.' + "<br />";
			error = error + 1;
		}
    });
	if(error != 0){
		$.prompt(msg);
		return false;
	}
	return true;
}
function savesuccess(message,url){
    $.prompt(message,
        { buttons: { Ok: true}, focus: 1, submit:function(e,v,m,f){
            if(v){
                if(url!='')
                 window.location.href = url;
                else{
                   $('.jqiclose').trigger('click');
                }
            }
        } });
}