const { src, dest, parallel, watch } = require('gulp');
const babel = require('gulp-babel');
const rename = require('gulp-rename');
const minifyJs = require('gulp-uglify');
const minifyCss = require('gulp-uglifycss');

function javascript() {
  return src('src/js/*.js')
    .pipe(babel({ presets: ['@babel/env'] }))
    .pipe(minifyJs())
    .pipe(rename({ extname: '.min.js' }))
    .pipe(dest('public/assets/js/'));
}

function css() {
  return src('src/css/*.css')
    .pipe(rename({ extname: '.min.css' }))
    .pipe(
      minifyCss({
        maxLineLen: 80,
        uglyComments: true,
      })
    )
    .pipe(dest('public/assets/css/'));
}

exports.default = function () {
  watch('src/css/*.css', parallel(css));
  watch('src/js/*.js', parallel(javascript));
}
