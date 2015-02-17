window.app = {};
(function() {
	
	try {
		app.BrainSocket = new BrainSocket(
		        new WebSocket('ws://'+window.location.host+':8080'),
		        new BrainSocketPubSub()
		);

		app.BrainSocket.Event.listen('status.request',function(msg)
		{
		    console.log(msg);
		});

		app.BrainSocket.Event.listen('app.success',function(msg)
		{
		    console.log(msg);
		});

		app.BrainSocket.Event.listen('app.error',function(msg)
		{
		    console.log(msg);
		});
	} catch(e) {
		console.error('Sorry, WebSockets are currently not available');
	}

	

})();
