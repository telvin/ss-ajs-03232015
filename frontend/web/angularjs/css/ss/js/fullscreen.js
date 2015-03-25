(function() {
	var
		fullScreenApi = {
			supportsFullScreen: false,
			nonNativeSupportsFullScreen: false,
			isFullScreen: function() { return false; },
			requestFullScreen: function() {},
			cancelFullScreen: function() {},
			fullScreenEventName: '',
			prefix: ''
		},
		browserPrefixes = 'webkit moz o ms khtml'.split(' ');

	// check for native support
	if (typeof document.cancelFullScreen != 'undefined') {
		fullScreenApi.supportsFullScreen = true;
	} else {
		// check for fullscreen support by vendor prefix
		for (var i = 0, il = browserPrefixes.length; i < il; i++ ) {
			fullScreenApi.prefix = browserPrefixes[i];

			if (typeof document[fullScreenApi.prefix + 'CancelFullScreen' ] != 'undefined' ) {
				fullScreenApi.supportsFullScreen = true;

				break;
			}
		}
	}

	// update methods to do something useful
	if (fullScreenApi.supportsFullScreen) {
		fullScreenApi.fullScreenEventName = fullScreenApi.prefix + 'fullscreenchange';

		fullScreenApi.isFullScreen = function() {
			switch (this.prefix) {
				case '':
					return document.fullScreen;
				case 'webkit':
					return document.webkitIsFullScreen;
				default:
					return document[this.prefix + 'FullScreen'];
			}
		}
		fullScreenApi.requestFullScreen = function(el) {
			return (this.prefix === '') ? el.requestFullScreen() : el[this.prefix + 'RequestFullScreen']();
		}
		fullScreenApi.cancelFullScreen = function(el) {
			return (this.prefix === '') ? document.cancelFullScreen() : document[this.prefix + 'CancelFullScreen']();
		}
	}
	else if (typeof window.ActiveXObject !== "undefined") { // Older IE.
		fullScreenApi.nonNativeSupportsFullScreen = true;
		fullScreenApi.requestFullScreen = fullScreenApi.requestFullScreen = function (el) {
			var wscript = new ActiveXObject("WScript.Shell");
			if (wscript !== null) {
				wscript.SendKeys("{F11}");
			}
		}
		fullScreenApi.isFullScreen = function() {
			return document.body.clientHeight == screen.height && document.body.clientWidth == screen.width;
		}
	}

	// jQuery plugin
	if (typeof jQuery != 'undefined') {
		jQuery.fn.requestFullScreen = function() {

			return this.each(function() {
				if (fullScreenApi.supportsFullScreen) {
					fullScreenApi.requestFullScreen(this);
				}
			});
		};
	}

	// export api
	window.fullScreenApi = fullScreenApi;
})();
function popupFull(url){
	//window.open(url, '', 'fullscreen=yes, scrollbars=auto');
	fullScreenApi.requestFullScreen(url)
}
$(document).ready(function(e) {
	var win_width = document.getElementsByTagName('body')[0].offsetWidth;
	var check_width = document.getElementById('wrapper').style.width;
	check_width = check_width.replace('px','');
	if(check_width < win_width){
		document.getElementById('wrapper').style.width = win_width+'px';
	}
});