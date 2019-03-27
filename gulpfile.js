// including plugins
var build_all_js, gulp = require('gulp'),
        sourcemaps = require('gulp-sourcemaps'),
        uglify = require('gulp-uglify'),
        concat = require('gulp-concat'),
        rev = require('gulp-rev'),
        revReplace = require('gulp-rev-replace'),
        sass = require('gulp-sass'),
        copy_scss_and_fonts;

sass.compiler = require('node-sass');

function copy_fonts() {
  return gulp
          .src(['./node_modules/slick-carousel/slick/fonts/*'])
          .pipe(gulp.dest('./sphp/css/fonts'));
}


function copy_img() {
  console.log('copy_img');
  return gulp
          .src(['./node_modules/slick-carousel/slick/ajax-loader.gif'])
          .pipe(rev())
          .pipe(revReplace())
          .pipe(gulp.dest('./sphp/css/images/ajax-loader.gif'));
}

function copy_tipso() {
  return gulp.src('./node_modules/tipso/src/tipso.css')
          .pipe(rev())
          .pipe(rename(function (file) {
            file.extname = '_tipso.scss';
          }))
          .pipe(revReplace())
          .pipe(gulp.dest('./sphp/scss/vendor'));
}



copy_scss_and_fonts = gulp.series(copy_fonts, copy_img, copy_tipso);

gulp.task('copy:scss+fonts', copy_scss_and_fonts);


gulp.task('javascript', function () {
  return gulp.src([
    './node_modules/jquery/dist/jquery.js',
    './node_modules/clipboard-polyfill/build/clipboard-polyfill.promise.js',
    './node_modules/slick-carousel/slick/slick.min.js',
    './node_modules/foundation-sites/dist/js/foundation.js',
    './node_modules/lazyloadxt/dist/jquery.lazyloadxt.extra.js',
    './node_modules/ion-rangeslider/js/ion.rangeSlider.js',
    './node_modules/tipso/src/tipso.js',
    './sphp/javascript/vendor/*.js',
    './sphp/javascript/app/modules/*.js',
    './sphp/javascript/app/sphp.js'])
          .pipe(concat('all.js'))
          .pipe(uglify())
          .pipe(gulp.dest('./sphp/javascript/dist'));
});

gulp.task('sass', function () {
  return gulp.src('./sphp/scss/**/*.scss')
          .pipe(sourcemaps.init())
          .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
          .pipe(sourcemaps.write('./maps'))
          .pipe(gulp.dest('./sphp/css'));
});

gulp.task('foobar:sass', function () {
  return gulp.src('./samiholck/scss/**/*.scss')
          .pipe(sourcemaps.init())
          .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
          .pipe(sourcemaps.write('./maps'))
          .pipe(gulp.dest('./css'));
});
gulp.task('file_watch', function () {
  gulp.watch('./samiholck/scss/**/*.scss', gulp.series('foobar:sass'));
  gulp.watch('./sphp/scss/**/*.scss', gulp.series('sass'));
  gulp.watch('./sphp/javascript/app/**/*.js', gulp.series('javascript'));
});

gulp.task('default', gulp.series('foobar:sass', 'sass', 'javascript'));

