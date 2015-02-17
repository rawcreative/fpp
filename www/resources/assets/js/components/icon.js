var React = require('react');
var Classable = require('../mixins/classable');

var Icon = React.createClass({

  mixins: [Classable],

  render: function() {

    var {
      className,
      ...other
    } = this.props;
   
    var classes = this.getClasses('icon');

    return (
      <i {...other} className={classes} />
    );
  }

});

module.exports = Icon;