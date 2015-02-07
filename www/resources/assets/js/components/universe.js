
var React = require('react');

var Universe = React.createClass({

	propTypes: {
		universe: React.PropTypes.number,
		startAddress: React.PropTypes.number,
		size: React.PropTypes.number,
		unicastAddress: function(props, propName, componentName) {
	      if (!/^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/.test(props[propName])) {
	        return new Error('Validation failed!');
	      }
	    }
	},
	isValid: function() {

	},
  	getUniverseData: function() {
  		var vals = {
  			active: this.refs.active.getDOMNode().checked,
  			universe: this.refs.universe.getDOMNode().value,
  			startAddress: this.refs.startAddress.getDOMNode().value,
  			size: this.refs.size.getDOMNode().value,
  			type: this.refs.type.getDOMNode().value,
  			unicastAddress: this.refs.unicastAddress.getDOMNode().value,
  		};
  		return vals;
  	},
	
	handleDelete: function() {

	
	},

	render: function() {
		return (
			<div className="universe">
				<div className="cell universe-index">{ this.props.index }</div>
				<div className="cell universe-active"><input type="checkbox" defaultChecked={ this.props.active } ref="active"  /></div>
				<div className="cell universe-number"><input type="text" ref="universe"  defaultValue={ this.props.universe } /></div>
				<div className="cell universe-start"><input type="text" ref="startAddress"  defaultValue={ this.props.startAddress } /></div>
				<div className="cell universe-size"><input type="text" ref="size" defaultValue={ this.props.size } /></div>
				<div className="cell universe-type">
					<select ref="type" defaultValue={ this.props.type }>
						<option value="unicast">Unicast</option>
						<option value="multicast">Multicast</option>
					</select>
				</div>
				<div className="cell universe-address"><input type="text" ref="unicastAddress" defaultValue={ this.props.unicastAddress } /></div>
				<button onClick={this.handleDelete} className="button hollow alert"><i className="ion-close"></i></button>
			</div>
		);
	}
});

module.exports = Universe;