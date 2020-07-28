// Gulp file to compile Addonify Quick View static resource

const gulp = require('gulp');
const sourcemaps = require('gulp-sourcemaps');
const sass = require('gulp-sass');
const concat = require('gulp-concat');
const uglify = require('gulp-uglify');
const postcss = require('gulp-postcss');
const autoprefixer = require('autoprefixer');
const cssnano = require('cssnano');
const replace = require('gulp-replace');
const notify = require('gulp-notify');
const plumber = require('gulp-plumber');
const rtlcss = require('gulp-rtlcss');
const rename = require('gulp-rename');
const browserSync = require('browser-sync').create();

// browser-sync start --proxy "localhost" --files "assets/dist/css/*.css" "assets/dist/js/*.js" "./*.php"

/*
===========================================================
=
= Change these constants according to your need
=
====================================================
*/

// 1# Script files path
const scriptpath = {

    script_src: [

        'assets/src/js/libraries/*.js',
        'assets/src/js/vendor/*.js',
        'assets/src/js/custom/*.js'
    ],

    script_dist: "assets/build/js/",
}
const output_js_file_name = "addonify-quick-view-public.js"; // what would you like to name your minified bundled js file

// 2# SASS/SCSS file path
const sasspath = {

    sass_src: "./assets/src/scss/**/*.scss",
    sass_dist: "assets/build/css/",
}
const compiled_sass_css_file_name = "addonify-quick-view-public.css"; // what would you like to name your compiled CSS file

// 3# LTR & RTL CSS path
const rtlcsspath = {

    rtlcss_src: "assets/build/css/" + compiled_sass_css_file_name,
    rtlcss_dist: "assets/build/css/", // where would you like to save your generated RTL CSS
}

/*
===========================================================
=
= Define task (Almost no chnages required)
=
====================================================
*/

gulp.task('scriptsTask',  function() {
    return gulp.src(scriptpath.script_src)
        .pipe(concat(output_js_file_name))
        .pipe(rename({ suffix: '.min' }))
        .pipe(uglify())
        .pipe(gulp.dest(scriptpath.script_dist));
});

gulp.task('sassTask', function() {
    var onError = function(err) {
        notify.onError({
            title: "Gulp",
            subtitle: "Failure!",
            message: "Error: <%= error.message %>",
            sound: "Beep"
        })(err);
        this.emit('end');
    };
    return gulp.src(sasspath.sass_src)
        .pipe(sourcemaps.init()) // initialize sourcemaps first
        .pipe(plumber({ errorHandler: onError }))
        .pipe(sass.sync().on('error', sass.logError))
        .pipe(postcss([autoprefixer('last 2 version'), cssnano()])) // PostCSS plugins
        .pipe(concat(compiled_sass_css_file_name))
        .pipe(sourcemaps.write('.')) // write sourcemaps file in current directory
        .pipe(gulp.dest(sasspath.sass_dist)); // put final CSS in dist folder
});

// task to convert LTR css to RTL
gulp.task('dortlTask', function() {
    return gulp.src(rtlcsspath.rtlcss_src)
        .pipe(rtlcss()) // Convert to RTL.
        .pipe(rename({ suffix: '-rtl' })) // Append "-rtl" to the filename.
        .pipe(gulp.dest(rtlcsspath.rtlcss_dist)); // Output RTL stylesheets.
});

// just hit the command "gulp" it will run the following tasks...
gulp.task('default', gulp.series('scriptsTask', 'sassTask', 'dortlTask', (done) => {

    gulp.watch(scriptpath.script_src, gulp.series('scriptsTask'));
    gulp.watch(sasspath.sass_src, gulp.series('sassTask'));
    gulp.watch(rtlcsspath.rtlcss_src, gulp.series('dortlTask'));
    done();
}));