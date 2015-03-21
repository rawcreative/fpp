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
var OverlayTrigger = RBS.OverlayTrigger;
var Tooltip = RBS.Tooltip;



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
        return {  
                data: this.props.data,
                activePlaylist: false,  };
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

         // <div className="player-row player-buttons">

                    //     <OverlayTrigger placement="left" overlay={<Tooltip>Play</Tooltip>}>
                    //         <Button className="play btn-info" xsmall="true" icon="ion-play" title="Play" />
                    //       </OverlayTrigger>
                    //    <Button className="stop btn-info" xsmall="true" icon="ion-stop" title="Stop Now" />
                    //    <Button className="stop-gracefully btn-info" xsmall="true" icon="ion-stop" title="Stop Gracefully" />
                    // </div>
                    // <div className="player-row player-buttons">
                    //     <Button className="shuffle" small="true" label="Shuffle" icon="ion-shuffle" />
                    //    <Button className="repeat" small="true" label="Repeat" icon="ion-refresh" />
                    // </div>
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
                                <Input type="select" className="playlist-select" onChange={this.handleSelectChange}>
                                    {this._getPlaylists()}
                                </Input>
                               
                        </div>
                    </div>

                    <div className="player-row now-playing">
                        <div className="track-desc">
                            <span className="label">Playing: </span>
                            <span className="current-track">{this.getCurrentTrack()}</span>
                        </div>
                        <div className="track-time">
                            <span className="current-time">{this.getCurrentTime()}</span>
                            <span> / </span>
                            <span className="total-time">{this.getTotalTime()}</span>
                        </div>
                    </div>
                    
                    <div className="player-buttons player-control">
                        <button id="previous-button" title="Previous"><i className="ion-ios-skipbackward"></i></button>
                        <button id="play-button" title="Play"><i className="ion-play"></i></button>
                        <button id="pause-button" title="Pause"><i className="ion-pause"></i></button>
                        <button id="stop-button" title="Stop"><i className="ion-stop"></i></button>
                        <button id="next-button" title="Next"><i className="ion-ios-skipforward"></i></button>
                        <button id="shuffle-button" title="Shuffle Off"><i className="ion-shuffle"></i></button>
                        <button id="repeat-button" title="Repeat Off"><i className="ion-refresh"><span></span></i></button>
                    </div>
                    
                    <div className="player-items">

                        <table className="table table-striped">

                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Media</th>
                                    <th>Sequence</th>
                                    <th>Duration</th>
                                    <th>Play Once</th>
                                </tr>
                            </thead>
                            <tbody>
                                {this.getPlayerItems()}
                            </tbody>
                        </table>
                    </div>
                </Panel>
			</div>
		);
	},
    handleSelectChange: function(e){
        var data = this.props.data;
        var playlist = this.props.data.playlists[e.target.value] || false;
        this.setState({ data: data, activePlaylist: playlist });
    },
    
    getCurrentTrack: function() {

        return 'The player is currently idle';
    },

    getCurrentTime: function() {
        return '-';
    },

    getTotalTime: function() {

        return '-';    
    },

    getPlayerItems: function() {
        var playlist = this.state.activePlaylist;
        var entries = playlist.entries || [];
        var items = [];

        items = entries.map(function(item, i) {
            return (
                    <tr> 
                        <td className="play"><i className="ion-play"></i></td>
                        <td className="media">{item.media}</td>
                        <td className="sequence">{item.sequence}</td>
                        <td className="duration">{item.duration}</td>
                        <td className="play-once"><span className="po-block po-start">S</span><span className="po-block po-end">E</span></td>
                    </tr>
                );
        }.bind(this));
        return items;
    },
    _getPlaylists: function() {
        var options = [];          

        options = this.props.data.playlists.map(function(playlist, i) {
            var ref = 'playlist' + i;
            return (<option ref={ref} value={i}>{playlist.name}</option>);
        }.bind(this));
        options.unshift(<option ref="" value="">Select A Playlist</option>);
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


