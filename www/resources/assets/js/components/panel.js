var React = require('react');
var Classable = require('../mixins/classable');
var Icon = require('./icon');
var PanelControls = require('./panelcontrols');

var Panel = React.createClass({
	mixins: [Classable],
	getInitialState: function() {
		return {
			collapsed: false
		};
	},

	shouldComponentUpdate: function () {
    	return !this._isChanging;
  	},

	render: function() {

		var classes = this.getClasses('panel', {
			collapsed: this.state.collapsed
		});

		var headingClass = this.props.separator ? 'panel-heading separator' : 'panel-heading'; 
		
		return (
			<div className={classes}>
				<div className={headingClass}>
					<div className="panel-title">{this.props.title}</div>
					<PanelControls controls={this.props.controls} />
				</div>
				<div className="panel-body" ref="panel">
					{this.props.children}
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
		
	}

});

module.exports = Panel;