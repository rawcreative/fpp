var React = require('react/addons');
var Button = require('./button');
var Icon = require('./icon');
var Input = require('react-bootstrap').Input;


var StatusPanel = React.createClass({
	getInitialState: function() {
		return {
			collapsed: false
		};
	},

	shouldComponentUpdate: function () {
    	return !this._isChanging;
  	},

	render: function() {
		var statusWidget = this.renderStatusWidget();
		var modeWidget = this.renderModeWidget();
		var classes = React.addons.classSet({
				'panel' : true,
				'fppd-status': true,
				'panel-collapsed' : this.state.collapsed
			});

		return (
			<div className={classes}>
				<div className="panel-heading separator">
					<div className="panel-title">FPPD</div>
					<div className="panel-controls">
					    <ul>
					      <li><a href="#" className="portlet-collapse" onClick={this.handleCollapse}>
					      	<Icon className={ this.state.collapsed ? 'pg-arrow_minimize' : 'pg-arrow_maximize'} /></a></li>
					      <li><a href="#" className="portlet-refresh" data-toggle="refresh">
					      	<Icon className="portlet-icon portlet-icon-refresh" /></a></li>
					      <li><a href="#" className="portlet-close" data-toggle="close">
					     	<Icon className="portlet-icon portlet-icon-close"/></a></li>
					    </ul>
				  </div>
				</div>
				<div className="panel-body" ref="panel">
					{statusWidget}
					{modeWidget}
				</div>
			</div>
		);
	},

	renderStatusWidget: function() {
		var status = this.props.data.fppd || 'stopped';
		var icon = status == 'running' ? 'icon ion-checkmark-circled success' : 'icon ion-close-circled danger';
		
		return (
				<div className="widget text-center current-status fppd-running">
					<span className="widget-header">Status</span>
					<span className="widget-icon"><i className={icon}></i></span>
					<span className="widget-text">{status}</span>
					<div className="widget-buttons">
						<Button className="fppd-stop" small="true" gradient="true" label="Stop" icon="ion-close" onClick={this.handleStop} />
						<Button className="fppd-restart" small="true" gradient="true" label="Restart" icon="ion-refresh" onClick={this.handleRestart} />
					</div>
				</div>		
			);
	},

	renderModeWidget: function() {
		var mode = this.props.data.mode || 'stopped';
		var icon = mode == 'stopped' ? 'x' : mode.charAt(0); //this.getModeIcon(mode);		

		return (
				<div className="widget text-center current-mode">
					<span className="widget-header">Mode</span>
					<span className="widget-icon"><span className="mode-icon">{icon}</span></span>
					<span className="widget-text">{mode}</span>
					<div className="widget-buttons">
					<Input type="select" className="fppd-mode-select" defaultValue="standalone">
				        	<option value="standalone">Standalone</option>
							<option value="master" >Master</option>
							<option value="remote" >Remote</option>
							<option value="bridge" >Bridge</option>
				     </Input>
						
					<Button className="fppd-mode-apply" small="true" gradient="true" label="Apply"  />
					</div>
				</div>		
			);
	},

	getCollapsableDOMNode: function () {
	    if (!this.isMounted() || !this.refs || !this.refs.panel) {
	      return null;
	    }

	    return this.refs.panel.getDOMNode();
	},

	handleCollapse: function(event) {
		this._isChanging = true;
		jQuery(this.getCollapsableDOMNode()).slideToggle('fast', function() {
			this._isChanging = false;
			this.setState({ collapsed: !this.state.collapsed });
		}.bind(this));
		
	},

	handleStop: function(evt) {
		console.log('FPPD Stop');
	},

	handleRestart: function(evt) {
		console.log('FPPD Restart');
	}

});

module.exports = StatusPanel;