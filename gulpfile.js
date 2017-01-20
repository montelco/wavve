var elixir = require('laravel-elixir');
var rename = require("gulp-rename");


require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass('app.scss')
        .webpack('app.js')
        .copy('node_modules/bootstrap-sass', 'resources/assets/sass/vendor/bootstrap-sass/')
        .copy('public/font-awesome/fonts', 'public/fonts')
        .copy('public/font-awesome', 'resources/assets/sass/vendor/font-awesome/');
});

// move contents of morris.css and place them into _morris.scss in assets/sass
gulp.src("public/css/plugins/morris.css")
    .pipe(rename("_morris.scss"))
    .pipe(gulp.dest("resources/assets/sass/vendor/morris/"));
