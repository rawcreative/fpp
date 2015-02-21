var elixir = require('laravel-elixir');
require('laravel-elixir-react');
require('laravel-elixir-browserify');
/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass('app.scss');
    //mix.react('main.jsx');
    // mix.browserify("outputs.js", {
    //     debug: true, 
    //     insertGlobals: false, 
    //     transform: ["reactify"],
    //     output: "public/js",
    //     rename: "outputs-bundle.js"
    // });
    mix.browserify([{
        src: 'outputs.js',
        debug: true, 
        insertGlobals: false, 
        transform: ["reactify"],
        output: "public/js",
        rename: "outputs-bundle.js"
    },{
        src: "dashboard.js",
        debug: true, 
        insertGlobals: false, 
        transform: ["reactify"],
        output: "public/js",
        rename: "dashboard-bundle.js"
    }]);
    mix.scripts([
    	'../../bower_components/jquery/dist/jquery.js',
    	'../../bower_components/underscore/underscore.js',
        '../../bower_components/moment/min/moment-with-locales.js',
        '../../bower_components/hammerjs/hammer.js',
        '../../bower_components/bootstrap-sass/assets/javascripts/bootstrap/alert.js',
        '../../bower_components/bootstrap-sass/assets/javascripts/bootstrap/button.js',
        '../../bower_components/bootstrap-sass/assets/javascripts/bootstrap/dropdown.js',
        '../../bower_components/bootstrap-sass/assets/javascripts/bootstrap/modal.js',
        '../../bower_components/bootstrap-sass/assets/javascripts/bootstrap/tab.js',
    	'../../bower_components/bootstrap-sass/assets/javascripts/bootstrap/transition.js',
       // 'js/plugins/calendar.js',
    	'js/plugins/portlets.js',
    	], 'public/js/scripts.js', 'resources/assets');
});
