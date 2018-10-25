var gulp = require('gulp');
var pug = require('gulp-pug');
var sass = require('gulp-sass');
var postcss = require('gulp-postcss');
var autoprefixer = require('gulp-autoprefixer');
var notify = require('gulp-notify');
var plumber = require('gulp-plumber');
var rev = require('gulp-rev');
var runSequence = require('run-sequence');
var sourcemaps = require('gulp-sourcemaps');
var sassLint = require('gulp-sass-lint');
var clean = require('gulp-clean');
var concat = require('gulp-concat');

var build = require('./src/build.config.json');

gulp.task('templates', function () {
    var css_manifest = requireUncached('./src/css-manifest.json');
    var js_manifest = requireUncached('./src/js-manifest.json');

    gulp.src(build.app_files.pug)
        .pipe(plumber({errorHandler: notify.onError("Error: <%= error.message %>")}))
        .pipe(pug({
            pretty: true,
            locals: {
                css_app: css_manifest['app.css'],
                js_app: js_manifest['app.js']
            }
        }))
        .pipe(gulp.dest(build.output_files.build))
});

function requireUncached(module){
    delete require.cache[require.resolve(module)]
    return require(module)
}

gulp.task('clean-css', function () {
    return gulp.src(build.output_files.build+'/'+build.output_files.css+'/*.{css,map}', {read: false})
        .pipe(clean());
});
gulp.task('clean-build', function () {
    return gulp.src(build.output_files.build+'/*', {read: false})
        .pipe(clean());
});

gulp.task('sass', function () {
  return gulp.src(build.app_files.sass)
      .pipe(sourcemaps.init())
      .pipe(sass().on('error', sass.logError))
      .pipe(autoprefixer( build.autoprefixer_options ))
      .pipe(rev())
      .pipe(sourcemaps.write('.'))
      .pipe(gulp.dest(build.output_files.build+'/'+build.output_files.css))
      .pipe(rev.manifest('css-manifest.json'))
      .pipe(gulp.dest('src'))
      ;
});

gulp.task('scripts', function() {
    return gulp.src(build.app_files.js)
        .pipe(sourcemaps.init())
        .pipe(concat('app.js'))
        .pipe(rev())
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest('build/js/'))
        .pipe(rev.manifest('js-manifest.json'))
        .pipe(gulp.dest('src'))
        ;
});

gulp.task('vendor_js', function () {
   return gulp.src(build.app_files.vendor_js)
       .pipe(concat('vendor.js'))
       .pipe(gulp.dest('build/js/'))
});

gulp.task('images', function () {
    return gulp.src(build.app_files.images)
        .pipe(gulp.dest('build/images'));
});

gulp.task('fonts', function () {
    return gulp.src(build.app_files.fonts)
        .pipe(gulp.dest('build/fonts'));
});

gulp.task('videos', function () {
    return gulp.src(build.app_files.videos)
        .pipe(gulp.dest('build/videos'));
});

gulp.task('php', function () {
    return gulp.src(build.app_files.php)
        .pipe(gulp.dest('build/php'));
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
    runSequence('clean-build',
                ['images',
                'fonts',
                'videos',
                'php',
                'sass-lint',
                'sass',
                'scripts',
                'vendor_js'],
                'templates',
                callback);
});

gulp.task('watch', function(){
    runSequence('clean-build',
            ['images',
            'fonts',
            'videos',
            'php',
            'sass-lint',
            'sass',
            'scripts',
            'vendor_js'],
            'templates',
        function(){
            var phpWatcher = gulp.watch('src/php/**/*.php', ['php']);
            var pugWatcher = gulp.watch('src/pug/**/*.pug', ['templates']);
            pugWatcher.on('change', function(event) {
                console.log('File ' + event.path + ' was ' + event.type + ', running tasks...');
            });
            var sassWatcher = gulp.watch('src/sass/**/*.scss', function(){
                runSequence('sass-lint',
                    'sass',
                    'templates'
                    );
            });
            sassWatcher.on('change', function(event) {
                console.log('File ' + event.path + ' was ' + event.type + ', running tasks...');
            });
            var jsWatcher = gulp.watch('src/js/**/*.js', function(){
                runSequence(
                    'scripts',
                    'templates'
                    );
            });
            jsWatcher.on('change', function(event) {
                console.log('File ' + event.path + ' was ' + event.type + ', running tasks...');
            });
        }
    );
});
