var React = require('react/addons');

var Button = React.createClass({

	_handleClick: function(e) {
		if(this.props.onClick) this.props.onClick(e);
	},
	render: function() {
	    var classNames = {};

		if(this.props.className) {
			classNames[this.props.className] = true;
		} 


		var classes = _.extend({
			'button' : true,
			'gradient' : this.props.gradient ? this.props.gradient : false,
			'small' : this.props.small ? this.props.small : false,
		}, classNames);

		classes = React.addons.classSet(classes);
		var icon = this.renderIcon();

		return ( 
			<button className={classes} onClick={this._handleClick}>
			{icon}
			{this.props.label}
			</button>
		);
	},
	renderIcon: function() {
		if(this.props.icon) {
			var classes = 'icon ' + this.props.icon;
			return <i className={classes}></i>;
		}
	}

});

module.exports = Button;