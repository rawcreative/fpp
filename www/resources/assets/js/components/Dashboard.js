var React = require('react');
var SetIntervalMixin = require('../mixins/interval');
var StatusPanel = require('./statuspanel');
var Panel = require('./panel');
var RBS = require('react-bootstrap');
var Input = RBS.Input;
var ButtonToolbar = RBS.ButtonToolbar;
var Button = require('./button');
var DropdownButton = RBS.DropdownButton;
var MenuItem = RBS.MenuItem;
var IonIcon = require('./icon');

var mui = require('material-ui');
var Toolbar = mui.Toolbar;
var ToolbarGroup = mui.ToolbarGroup;
var DropDownMenu = mui.DropDownMenu;
var DropDownIcon = mui.DropDownIcon;

function capitalize(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

var Dashboard = React.createClass({
	mixins: [SetIntervalMixin],
	
	getInitialState: function () {
        return {data: this.props.data };
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
                    { classname : 'portlet-collapse', icon: 'pg-arrow_minimize', onSelect: 'collapse' },
                    { classname : 'portlet-close', icon: 'portlet-icon portlet-icon-close', onSelect: 'remove' }];

        var stopMenuItems = [
          { payload: '1', text: 'Stop Now' },
          { payload: '2', text: 'Stop Gracefully' }
        ];     


		return (
			<div className="dashboard-container">
				<StatusPanel data={this.state.data} collapsible="true"/>
                <Panel 
                    className="player-status"
                    title="Player"
                    data={this.state.data} 
                    collapsible="true"
                    separator="true"
                    controls={playerControls}>
                  
                    <div className="player-header player-row">
                        <div className="status">
                            <span className="label">Status:</span>
                            <span className="value">{capitalize(this.props.data.fppd)}</span>
                        </div>
                        <div className="playlist">
                            <span className="label">Playlist: </span>
                            <span className="playlist-select">
                                <Input type="select" className="playlist">
                                    {this._getPlaylists()}
                                </Input>
                                <Button className="playlist-load" small="true" gradient="true" label="Load" />
                            </span>
                        </div>
                    </div>

                    <div className="player-row now-playing"></div>
                   
                    <div className="player-row player-buttons">
                       <Button className="play" small="true" label="Play" icon="ion-play" />
                       <Button className="stop" small="true" label="Stop Now" icon="ion-stop" />
                       <Button className="stop-gracefully" small="true" label="Stop Gracefully" icon="ion-stop" />
                    </div>
                    <div className="player-row player-buttons">
                        <Button className="shuffle" small="true" label="Shuffle" icon="ion-shuffle" />
                       <Button className="repeat" small="true" label="Repeat" icon="ion-refresh" />
                    </div>
                </Panel>
			</div>
		);
	},

    _getPlaylists: function() {
        var options = [];          


        options = this.props.data.playlists.map(function(playlist, i) {
            var ref = 'playlist' + i;
            return (<option ref={ref} value={playlist}>{playlist}</option>);
        }.bind(this));

        return options;    
    },

	requestData: function () {
        
        //this.setState({data: window.FPP_DATA });

        // $.getJSON('api/fppd/fstatus', function(data) {
        //    	this.setState({data: data.response});
        // }.bind(this));
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


