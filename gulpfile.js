const gulp         = require('gulp'),
      uglify       = require('gulp-uglify'),
      imagemin     = require('gulp-imagemin'),
      del          = require('del'),
      replace      = require('gulp-replace'),
      rev          = require('gulp-rev-append'),
      ifElse       = require('gulp-if-else'),
      //htmlreplace  = require('gulp-html-replace'),
      base64       = require('gulp-base64'),
      postcss      = require('gulp-postcss'),
      autoprefixer = require('autoprefixer'),
      cssnano      = require('cssnano');

const SRC              = './src/',
      SRC_CSS          = SRC + 'css/**/*.css',
      SRC_JS           = SRC + 'js/**/*.js',
      SRC_FONTS        = SRC + 'fonts/**',
      // SRC_VIEWS        = SRC + 'View/*/View/*/*.html',
      SRC_STATIC_HTML  = SRC + 'html/*.html',
      SRC_IMG          = SRC + 'images/**/*.*',

      DIST             = './Public/',
      DIST_CSS         = DIST + 'css/',
      DIST_JS          = DIST + 'js/',
      DIST_FONTS       = DIST + 'fonts/',
      // DIST_VIEWS       = './Application/',
      DIST_STATIC_HTML = DIST + 'html/',
      DIST_IMG         = DIST + 'images/';

var urlTag = '';
var NODE_ENV = '';

gulp.task('uglify', function () {
    return gulp.src(SRC_JS).pipe(replace('__target__', urlTag))
               .pipe(replace('__PUBLIC__/', '../'))
               .pipe(ifElse(NODE_ENV === 'public', uglify))
               .pipe(gulp.dest(DIST_JS));
});

gulp.task('css', function () {
    var processes = [cssnano];
    gulp.src(SRC_CSS)
        .pipe(ifElse(NODE_ENV === 'public', function () {
            return postcss(processes)
        }))
        .pipe(base64({
            extensions: ['png', /\.jpg#datauri$/i],
            maxImageSize: 10 * 1024 // bytes,
        }))
        .pipe(gulp.dest(DIST_CSS));
});


gulp.task('images', function () {
    return gulp.src(SRC_IMG)
               .pipe(imagemin({
                   progressive: true
               }))
               .pipe(gulp.dest(DIST_IMG));
});

gulp.task('copy_fonts', function () {
    return gulp.src(SRC_FONTS)
               .pipe(gulp.dest(DIST_FONTS));
});

/*gulp.task('build_view', function () {
    return gulp.src(SRC_VIEWS,{base:'View'})
               .pipe(rev())
               .pipe(replace('__target__', urlTag))
               .pipe(replace('..\/..\/', '__PUBLIC__/'))
               .pipe(replace('<a href="..\/', '<a href="__APP__/'))
               .pipe(htmlreplace({
                   js: {
                       src: '',
                       tpl: ''
                   }
               }))
               .pipe(gulp.dest(DIST_VIEWS));
});*/

gulp.task('clean', function () {
    return del([DIST]);
});

gulp.task('copy_static_html', function () {
    return gulp.src(SRC_STATIC_HTML)
               .pipe(gulp.dest(DIST_STATIC_HTML));
});

gulp.task('build', ['clean'], function () {
    NODE_ENV = 'public';
    gulp.start('uglify', 'css', 'copy_fonts', 'images', 'copy_static_html');
});

gulp.task('auto', function () {
    gulp.watch([SRC_CSS], ['css']);
    gulp.watch([SRC_JS], ['uglify']);
    // gulp.watch([SRC_VIEWS], ['build_view']);
    gulp.watch([SRC_STATIC_HTML], ['copy_static_html']);
    gulp.watch([SRC_FONTS], ['copy_fonts']);
});
