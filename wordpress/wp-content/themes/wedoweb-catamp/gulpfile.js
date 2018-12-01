var gulp = require('gulp');
var sass = require('gulp-sass');
var postcss = require('gulp-postcss');
var autoprefixer = require('gulp-autoprefixer');
var notify = require('gulp-notify');
// var plumber = require('gulp-plumber');
var rev = require('gulp-rev');
var runSequence = require('run-sequence');
var sourcemaps = require('gulp-sourcemaps');
var sassLint = require('gulp-sass-lint');
var clean = require('gulp-clean');
var concat = require('gulp-concat');
const babel = require('gulp-babel');
const webpack = require('webpack-stream');

/** TODO add:
 * gulp-rev | done
 * gulp-sass-lint | done
 * gulp-livereload
 * */

var build = require('./src/build.config.json');

function requireUncached(module){
    delete require.cache[require.resolve(module)]
    return require(module)
}

gulp.task('clean-css', function () {
    return gulp.src(build.output_files.css+'/*.{css,map}', {read: false})
        .pipe(clean());
});
gulp.task('clean-js', function () {
    console.log('clean js');
    return gulp.src(build.output_files.js+'/*.{js,map}', {read: false})
        .pipe(clean());
});

gulp.task('sass', function () {
    return gulp.src(build.app_files.sass)
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(autoprefixer( build.autoprefixer_options ))
        .pipe(rev())
        .pipe(sourcemaps.write())
        .pipe(gulp.dest(build.output_files.css))
        .pipe(rev.manifest('css-manifest.json'))
        .pipe(gulp.dest('src'))
        ;
});

gulp.task('scripts', function() {
    return gulp.src(build.app_files.js)
        .pipe(webpack({
            output: {
                filename: 'app.js',
            },
        }))
        .pipe(sourcemaps.init())
        .pipe(babel({
            presets: [["env", {
                "targets": {
                    "browsers": [ "last 2 versions"],
                }
            }]]
        }))
        .pipe(rev())
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest('js/'))
        .pipe(rev.manifest('js-manifest.json'))
        .pipe(gulp.dest('src'))
        ;
});

gulp.task('vendor_js', function () {
    return gulp.src(build.app_files.vendor_js)
        .pipe(concat('vendor.js'))
        .pipe(gulp.dest('js/'))
});

/**
 * Different gulp task for the sass-lint
 * because in order to include all the scss files
 * a wildcard is necessary in the gulp.src
 **/
gulp.task('sass-lint', function () {
    return gulp.src( build.sass_lint.src )
        .pipe(sassLint({configFile:build.sass_lint.options.config_file}))
        .pipe(sassLint.format())
        .pipe(sassLint.failOnError())
});

gulp.task('default', function(callback){
    runSequence('clean-js', 'clean-css',
        ['sass-lint',
            'sass',
            'scripts',
            'vendor_js'],
        callback);
});

gulp.task('watch', function(){
    runSequence('clean-js', 'clean-css',
        ['sass-lint',
            'sass',
            'scripts',
            'vendor_js'],
        function(){
            var sassWatcher = gulp.watch('src/sass/**/*.scss', function(){
                runSequence('sass-lint',
                    'clean-css', 'sass'
                );
            });
            sassWatcher.on('change', function(event) {
                console.log('File ' + event.path + ' was ' + event.type + ', running tasks...');
            });
            var jsWatcher = gulp.watch('src/js/**/*.js', function(){
                runSequence(
                    'clean-js', 'scripts'
                );
            });
            jsWatcher.on('change', function(event) {
                console.log('File ' + event.path + ' was ' + event.type + ', running tasks...');
            });
        }
    );
});
