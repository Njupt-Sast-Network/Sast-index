var gulp = require('gulp'),
    ugjs = require('gulp-uglify'),
    imagemin = require('gulp-imagemin'),
    clean = require('gulp-clean'),
    replace = require('gulp-replace'),
    rev = require('gulp-rev-append'),
    ifElse = require('gulp-if-else'),
    htmlreplace = require('gulp-html-replace'),
    browserSync = require('browser-sync'),
    base64 = require('gulp-base64'),
    php = require('gulp-connect-php');
var postcss = require('gulp-postcss'); //postcss本身
var autoprefixer = require('autoprefixer');
var precss = require('precss'); //提供像scss一样的语法
var cssnano = require('cssnano'); //更好用的css压缩!
var sourcemaps = require('gulp-sourcemaps');
var path = './src/',
    csspath = './src/css/**/*.css',
    jspath = './src/js/**/*.js',
    htmlpath = './src/views/**/*.html',
    ifonpath = './src/fonts/**';
var disPath = 'production/Public/',
    disCssPath = 'production/public/css',
    disJsPath = 'production/Public/js',
    disHtmlPath = 'production/Application/Index/View',
    disifonpath = 'production/Public/fonts';
var urlTag = '';
var NODE_ENV = '';
const reload = browserSync.reload;


gulp.task('ugjs', function() {
    return gulp.src(jspath).pipe(replace('__target__', urlTag))
               .pipe(replace('../../', '../../Public/'))
               .pipe(ifElse(NODE_ENV === 'public', ugjs))
               .pipe(gulp.dest(disJsPath));
});

gulp.task('css', function() {
    var processes = [cssnano];
    gulp.src(csspath)
        .pipe(ifElse(NODE_ENV === 'public', function() {
            return postcss(processes)
        }))
        .pipe(base64({
            extensions: ['png', /\.jpg#datauri$/i],
            maxImageSize: 10 * 1024 // bytes,
        }))
        .pipe(gulp.dest(disCssPath));
});


gulp.task('images', function() {
    return gulp.src('src/images/**/*.*')
               .pipe(imagemin({
                   progressive: true
               }))
               .pipe(gulp.dest('production/Public/images'));
});

gulp.task('iconfont', function() {
    return gulp.src(ifonpath)
               .pipe(gulp.dest(disifonpath));
});

gulp.task('view', ['clean'], function() {
    return gulp.src(htmlpath)
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
               .pipe(gulp.dest(disHtmlPath));
});

gulp.task('clean', function() {
    return gulp.src(disHtmlPath, {
        read: true
    })
               .pipe(clean());
});

gulp.task('build', function() {
    NODE_ENV = 'public';
    gulp.start('view', 'ugjs', 'css', 'iconfont', 'images');
});

gulp.task('auto', function() {
    gulp.watch([csspath], ['css']);
    gulp.watch([jspath], ['ugjs']);
    gulp.watch([htmlpath], ['view']);
    gulp.watch('./src/component/*.html', ['component']);
});
// gulp.task('reload', function() {
//     browserSync.init(chtmlpath, {
//         startPath: "/views/",
//         server: cpath,
//         notify: false
//     });
//     gulp.watch([csasspath]).on('change', function() {
//         runSequence('collegesass', 'collegecss', function() {
//             bsReload();
//         });
//     });
//     gulp.watch([cjspath], ['collegejs']).on('change', bsReload);
//     gulp.watch([chtmlpath], ['collegeview']).on('change', bsReload);
// });
// gulp.task('php',function () {
//     php.server({ base: 'production', port: 8010, keepalive: true});
// })
