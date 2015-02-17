var React = require('react'),
	UniverseList = require('./components/universelist');

var universes = [
				{active: true, universe: 1, startAddress: 1, size: 512, type: 'unicast', unicastAddress: '10.10.10.10'},
				{active: true, universe: 2, startAddress: 513, size: 512, type: 'unicast', unicastAddress: '10.10.10.10'},
				{active: true, universe: 3, startAddress: 1025, size: 512, type: 'unicast', unicastAddress: '10.10.10.10'},
				{active: true, universe: 4, startAddress: 1537, size: 512, type: 'unicast', unicastAddress: '10.10.10.10'}
			];


React.render(
  <UniverseList data={universes}  />,
  document.getElementById('universe-outputs')
);