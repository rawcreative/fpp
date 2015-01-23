window.app = {};

app.BrainSocket = new BrainSocket(
        new WebSocket('ws://localhost:8080'),
        new BrainSocketPubSub()
);

app.BrainSocket.Event.listen('some.event',function(msg)
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