var React = require('react');
var Reflux = require('reflux');
var Dashboard = require('./components/Dashboard');

var initialData = JSON.parse(document.getElementById("initial-data").innerHTML);

React.render(
  <Dashboard data={initialData}/>,
  document.getElementById('dashboard')
);
