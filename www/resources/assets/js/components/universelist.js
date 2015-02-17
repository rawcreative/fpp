var React = require('react');
var Universe = require('./universe');
var Button = require('./button');
var UniverseList = React.createClass({
	
	handleSubmit: function() {
	
		var data = this.state.universes.map(function(universe, i) {
			
			return this.refs['universe'+i].getUniverseData();
		}, this)
		console.log(data);
	},
	getInitialState: function() {
		return {

			universes: this.props.data 
		};
	},
	render: function() {

		var nodes = this.state.universes.map(function(universe, i) {
			var ref = 'universe' + i;
			return (
		        <Universe 
		        	key={universe.universe}
		        	index={i+1}
		        	active={universe.active}
		        	universe={universe.universe}
		        	startAddress={universe.startAddress}
		        	size={universe.size}
		        	type={universe.type}
		        	unicastAddress={universe.unicastAddress} 
		        	onDelete={this.deleteUniverse}
		        	onUpdate={this.updateUniverse} 
		        	ref={ref} />		        
     			 );
		}.bind(this));
		return (
			<div className="universe-list">
				<div className="header-row universe">
					<span className="universe-index">#</span>
					<span className="universe-active">Active</span>
					<span className="universe-number">Universe</span>
					<span className="universe-start">Start</span>
					<span className="universe-size">Size</span>
					<span className="universe-type">Type</span>
					<span className="universe-address">Unicast Address</span>
					
				</div>
				{nodes}
				<Button className="save-universes" onClick={this.handleSubmit} label="Save" />
			</div>
		);
	}
});

module.exports = UniverseList;
