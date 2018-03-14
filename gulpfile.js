const gulp = require('gulp');
const plumber = require('gulp-plumber');
const sass = require('gulp-sass');
const postcss = require('gulp-postcss');
const autoprefixer = require('autoprefixer');
const sourcemaps = require('gulp-sourcemaps');
const groupmq = require('gulp-group-css-media-queries');
const concatCss = require('gulp-concat-css');
// const bs = require('browser-sync');bs
const sassLint = require('gulp-sass-lint');

const SASS_SOURCES = [
  './*.scss', // This picks up our style.scss file at the root of the theme
  'css/**/*.scss', // All other Sass files in the /css directory
];

/**
 * Compile Sass files
 */
gulp.task('compile:sass', ['lint:sass'], () =>
  gulp.src(SASS_SOURCES, { base: './' })
    .pipe(plumber()) // Prevent termination on error
    .pipe(sass({
      indentType: 'tab',
      indentWidth: 1,
      outputStyle: 'expanded', // Expanded so that our CSS is readable
    })).on('error', sass.logError)
    .pipe(postcss([
      autoprefixer({
        browsers: ['last 2 versions'],
        cascade: false,
      })
    ]))
    .pipe(groupmq()) // Group media queries!
    .pipe(gulp.dest('./dist/')) // Output compiled files in the same dir as Sass sources
    ); // Stream to browserSync



gulp.task('compile:css',  () => {
  return gulp.src(['./dist/style.css', './node_modules/bootstrap/dist/css/bootstrap-grid.css'])
    .pipe(concatCss("./style.css"))
    .pipe(gulp.dest('./'));
});
/**
 * Start up browserSync and watch Sass files for changes
 */
gulp.task('watch:sass', ['compile:sass', 'compile:css'], () => {
  // bs.init({
  //   proxy: 'http://wp.docker.localhost:8000/'
  // });

  gulp.watch(SASS_SOURCES, ['compile:sass', 'lint:sass', 'compile:css']);
});

/**
 * Lint Sass
 */
gulp.task('lint:sass', () =>
  gulp.src(SASS_SOURCES)
    .pipe(plumber())
    .pipe(sassLint())
    .pipe(sassLint.format()));

/**
 * Default task executed by running `gulp`
 */
gulp.task('default', ['watch:sass']);