/**
 * Created by Richard on 2016/7/12.
 */
const gulp = require('gulp'),
      uglify = require('gulp-uglify'),
      del = require('del'),
      replace = require('gulp-replace'),
      pump = require('pump'),
      rename = require('gulp-rename'),
      cssnano = require('gulp-cssnano');

const PUBLIC = './Public/',
      SRC = PUBLIC+'src/',
      DIST = PUBLIC+'dist/';

gulp.task('clean',function() {
    return del([
        DIST+'js/*',
        DIST+'css/*',
        DIST+'images/*',
        DIST+'fonts/*'
    ])
});

gulp.task('default',function () {
    gulp.start(['uglyjs','uglycss'])
});

gulp.task('jstpl',function () {
    return gulp.src(SRC+'js/*.js')
               .pipe(replace('__PUBLIC__/','../../'))
               .pipe(gulp.dest(DIST+'js/'))
});

gulp.task('uglyjs',['jstpl'],function (cb) {
    pump([
            gulp.src([DIST+'js/*.js','!'+DIST+'js/*.min.js']),
            uglify(),
            rename(function (path) {
                path.extname = '.min.js'
            }),
            gulp.dest(DIST+'js/')
        ],
        cb
    );
});

gulp.task('uglycss',function () {
    return gulp.src(SRC+'css/*.css')
               .pipe(cssnano())
               .pipe(rename(function (path) {
                   path.extname = '.min.css'
               }))
               .pipe(gulp.dest(DIST+'css/'));
});