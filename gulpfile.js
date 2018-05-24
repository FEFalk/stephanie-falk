var gulp = require('gulp');
var sass = require('gulp-sass');

gulp.task('sass', function () {
  return gulp.src('./wp-content/themes/stephanie-falk/assets/sass/*.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(gulp.dest('./wp-content/themes/stephanie-falk/assets/css/'));
});
 
gulp.task('default', ['sass'], function() {
    gulp.watch('./wp-content/themes/stephanie-falk/assets/sass/*.scss', ['sass']);
});