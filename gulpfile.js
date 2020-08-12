var gulp = require('gulp');
var wpPot = require('gulp-wp-pot');

gulp.task('default', function () {
    return gulp.src('./**/*.php')
        .pipe(wpPot( {
            domain: 'addonify-quick-view',
            package: 'addonify-quick-view'
        } ))
        .pipe(gulp.dest('languages/addonify-quick-view.pot'));
});
