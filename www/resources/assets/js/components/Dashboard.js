var React = require('react');
var SetIntervalMixin = require('../mixins/interval');
var StatusPanel = require('./statuspanel');
var Panel = require('./panel');

var Dashboard = React.createClass({
	mixins: [SetIntervalMixin],
	
	getInitialState: function () {
        return {data: {}};
    },

    componentDidMount: function () {
    	var hidden = "hidden";

    	// Standards:
    	if (hidden in document)
    	  document.addEventListener("visibilitychange", this.visibilityChange);
    	else if ((hidden = "mozHidden") in document)
    	  document.addEventListener("mozvisibilitychange", this.visibilityChange);
    	else if ((hidden = "webkitHidden") in document)
    	  document.addEventListener("webkitvisibilitychange", this.visibilityChange);
    	else if ((hidden = "msHidden") in document)
    	  document.addEventListener("msvisibilitychange", this.visibilityChange);
    	// IE 9 and lower:
    	else if ("onfocusin" in document)
    	  document.onfocusin = document.onfocusout = this.visibilityChange;
    	// All others:
    	else
    	  window.onpageshow = window.onpagehide = window.onfocus = window.onblur = this.visibilityChange;

    	this._hidden = hidden;

    	this.requestData();
    //	this.setInterval(this.requestData, 1000);        
    },

    componentWillUnmount: function() {
    	var hidden = "hidden";

    	if (hidden in document)
    	  document.removeEventListener("visibilitychange", this.visibilityChange);
    	else if ((hidden = "mozHidden") in document)
    	  document.removeEventListener("mozvisibilitychange", this.visibilityChange);
    	else if ((hidden = "webkitHidden") in document)
    	  document.removeEventListener("webkitvisibilitychange", this.visibilityChange);
    	else if ((hidden = "msHidden") in document)
    	  document.removeEventListener("msvisibilitychange", this.visibilityChange);
    	
  	},
	
	render: function() {
        var playerControls = [
                    { classname : 'portlet-collapse', icon: 'pg-arrow_minimize' },
                    { classname : 'portlet-close', icon: 'portlet-icon portlet-icon-close' }];
		return (
			<div className="dashboard-container">
				<StatusPanel data={this.state.data} collapsible="true"/>
                <Panel 
                    className="player-status"
                    title="Player"
                    data={this.state.data} 
                    collapsible="true"
                    separator="true"
                    controls={playerControls} />
			</div>
		);
	},

	requestData: function () {
  
        $.getJSON('api/fppd/fstatus', function(data) {
           	this.setState({data: data.response});
        }.bind(this));
    },

    visibilityChange: function(evt) {
    	var visibility = 'visible',
    		v = "visible", 
    	    h = "hidden",
    	    evtMap = {
    	      focus:v, focusin:v, pageshow:v, blur:h, focusout:h, pagehide:h
    	    };

    	evt = evt || window.event;
    	
    	if (evt.type in evtMap)
    	  visibility = evtMap[evt.type];
    	else
    	  visibility = document[this._hidden] ? "hidden" : "visible";
    	
    	if(visibility == 'visible')
  //  		this.setInterval(this.requestData, 1000);

    	if(visibility == 'hidden')
    		this.intervals.map(clearInterval);

    }


});

module.exports = Dashboard;


