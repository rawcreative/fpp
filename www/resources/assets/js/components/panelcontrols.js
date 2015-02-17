var React = require('react');
var Classable = require('../mixins/classable');
var Icon = require('./icon');

var PanelControls = React.createClass({
		mixins:[Classable],
	
	render: function() {
		var classes = this.getClasses('panel-controls', {});
		return (
			<div className={classes}>
				<ul>
				{this._getChildren()}
				</ul>
			</div>
		);
	},

	_getChildren: function() {
		var children = [],
			control,
			component;

		for (var i=0; i < this.props.controls.length; i++) {
      		control = this.props.controls[i];

      		// switch(control.type) {
      		// 	case 'toggle' : 
      				component = (
      					<li>
	      					<a href="#" className={control.classname}>
	      						<Icon className={control.icon} />
	      					</a>
      					</li>);
      		// 		break;
      		// }
      		children.push(component);
      	}

      	return children;
	}

});

module.exports = PanelControls;