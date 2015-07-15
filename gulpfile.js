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

var elixir = require('laravel-elixir');

var bower_path = "./vendor/bower_components";
var paths = {
  'jquery'     : bower_path + "/jquery/dist",
  'bootstrap'  : bower_path + "/bootstrap-sass-official/assets",
  'fontawesome': bower_path + "/fontawesome"
};

mix.sass("app.scss", "public/assets/css", {
  includePaths: [
    paths.bootstrap + '/stylesheets',
    paths.fontawesome + '/scss'
  ]
});

elixir(function(mix) {
	mix.copy(paths.bootstrap + 'stylesheets/**','./resources/assests/sass/bootstrap')
		.copy(paths.bootstrap + 'fonts/bootstrap/**','public/fonts')
		.compass('app.scss','public/css/',{
			style:"compressed",
			sass:"./resources/assets/sass"
		})
		.scripts([
			paths.jquery + "dist/jquery.js",
			paths.bootstrap + "javascripts/bootstrap.js"
		], './','public/js/app.js');
});