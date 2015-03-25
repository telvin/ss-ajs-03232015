app.service('SignalService', function($rootScope) {
    this.broadcast = function(signalName, sendData) {$rootScope.$broadcast(signalName, sendData)}
    this.listen = function(signalName, callback) {$rootScope.$on(signalName,callback)}
})