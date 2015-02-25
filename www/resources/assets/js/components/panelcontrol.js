var React = require('react');
var Classable = require('../mixins/classable');
var Icon = require('./icon');

var PanelControl = React.createClass({

	render: function() {
		return (
			<li>
				<a href="#" className={this.props.classname} onClick={this.handleClick}>
					<Icon className={this.props.icon} />
				</a>
			</li>
		);
	},

	handleClick: function(event) {
		if (this.props.onSelect) {
	      event.preventDefault();
	      var idx = this.props.index;
	      this.props.onSelect(event, idx, this.props.key);
	    }
	}

});

module.exports = PanelControl;