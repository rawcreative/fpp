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
    mix.browserify("main.js", {
        debug: true, 
        insertGlobals: true, 
        transform: ["reactify"],
        output: "public/js",
        rename: "bundle.js"
    });
    mix.scripts([
    	'../../bower_components/jquery/dist/jquery.js',
    	'../../bower_components/underscore/underscore.js',
    	'../../bower_components/react/react.js',
    	], 'public/js/scripts.js');
});
