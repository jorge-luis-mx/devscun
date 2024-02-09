
const { src, dest, watch, series,parallel }= require('gulp');
const sass=require('gulp-sass')(require('sass'));
//para soporte en distos navegadores styles
const postcss = require('gulp-postcss');
const autoprefixer= require('autoprefixer');
//para minificar js
const minify = require('gulp-minify');

function css(done){
   //compilar sass
   //pasos: 1 -identificar el archivo, 2 -compilarla, 3 -guardar el .css
   src('assets/scss/app.scss')
      .pipe(sass({outputStyle:'compressed'}))
      .pipe(postcss([autoprefixer()]))
      .pipe(dest('assets/build/css'))
      done();
}

function dev(){
   watch('assets/scss/**/*.scss',css);
   watch('assets/js/**/*.js',minjs);
}

//function for min js

function minjs(done){
   src('assets/js/menu.js')
   .pipe(minify({
       ext: {
           min: '.min.js'
       },
       ignoreFiles: ['-min.js']
   }))
   .pipe(dest('assets/build/js'));
   done();
}


exports.css=css;
exports.dev=dev;
exports.minjs=minjs;
exports.default=parallel(css,minjs,dev);
//exports.default=parallel(css,dev);
//series: se inicia una tarea, hasta que finaliza e inicia la siguiente
//paralel:todos inicia al mismo tiempo

//ejcutar asi: gulp dev
