var StatusService = function(config) {
	// service instance
	var Service = {};
	var pendingCallbacks = [];

	var hostname = config.hostname || window.location.hostname;
	var port = (config.port ? ':' + config.port : '') || (location.port ? ':' + location.port : '');
	var path = config.path || '';
	var wsUri = 'ws://' + hostname + port + path;

	var ws = new WebSocket(wsUri);

	ws.onopen = function () {
	    // console.log('Socket opened!')
	};
	ws.onmessage = function (message) {
	    onMessageReceived(JSON.parse(message.data));
	};

	function onMessageReceived (data) {
	    // console.log('onMessageReceived, data:', data, 'ws.readyState', ws.readyState);
	    pendingCallbacks.forEach(function (cb) {
	       cb.call(null, data);
	    });
	}

	function onStatusReceived (cb) {
	    pendingCallbacks.push(cb);
	}

	Service.onStatusReceived = onStatussReceived;

	return Service;
};

module.exports = StatusService;

