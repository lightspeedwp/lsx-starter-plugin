var gulp = require('gulp');

gulp.task('default', function() {	 
	console.log('Use the following commands');
	console.log('--------------------------');
	console.log('gulp compile-css    to compile the {plugin-name}.scss to {plugin-name}.css and {plugin-name}-admin.scss to {plugin-name}-admin.css.');
	console.log('gulp compile-js     to compile the {plugin-name}.js to {plugin-name}.min.js and {plugin-name}-admin.js to {plugin-name}-admin.min.js.');
	console.log('gulp watch          to continue watching the files for changes.');
	console.log('gulp wordpress-lang to compile the {plugin-name}.pot, en_EN.po and en_EN.mo');
});

var sass = require('gulp-sass');
var jshint = require('gulp-jshint');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var sort = require('gulp-sort');
var wppot = require('gulp-wp-pot');
var gettext = require('gulp-gettext');

gulp.task('sass', function () {
	gulp.src('assets/css/{plugin-name}.scss')
		.pipe(sass())
		.pipe(gulp.dest('assets/css/'));
});

gulp.task('admin-sass', function () {
	gulp.src('assets/css/{plugin-name}-admin.scss')
		.pipe(sass())
		.pipe(gulp.dest('assets/css/'));
});

gulp.task('js', function () {
	gulp.src('assets/js/{plugin-name}.js')
		.pipe(jshint())
		.pipe(jshint.reporter('fail'))
		.pipe(concat('{plugin-name}.min.js'))
		.pipe(uglify())
		.pipe(gulp.dest('assets/js'));
});

gulp.task('admin-js', function () {
	gulp.src('assets/js/{plugin-name}-admin.js')
		.pipe(jshint())
		.pipe(jshint.reporter('fail'))
		.pipe(concat('{plugin-name}-admin.min.js'))
		.pipe(uglify())
		.pipe(gulp.dest('assets/js'));
});
 
gulp.task('compile-css', (['sass', 'admin-sass']));
gulp.task('compile-js', (['js', 'admin-js']));

gulp.task('watch', function() {
	gulp.watch('assets/css/{plugin-name}.scss', ['sass']);
	gulp.watch('assets/css/{plugin-name}-admin.scss', ['admin-sass']);
	gulp.watch('assets/js/{plugin-name}.js', ['js']);
	gulp.watch('assets/js/{plugin-name}-admin.js', ['admin-js']);
});

gulp.task('wordpress-pot', function() {
	return gulp.src('**/*.php')
		.pipe(sort())
		.pipe(wppot({
			domain: '{plugin-name}',
			package: '{plugin-name}',
			team: 'LightSpeed <webmaster@lsdev.biz>'
		}))
		.pipe(gulp.dest('languages/{plugin-name}.pot'));
});

gulp.task('wordpress-po', function() {
	return gulp.src('**/*.php')
		.pipe(sort())
		.pipe(wppot({
			domain: '{plugin-name}',
			package: '{plugin-name}',
			team: 'LightSpeed <webmaster@lsdev.biz>'
		}))
		.pipe(gulp.dest('languages/en_EN.po'));
});

gulp.task('wordpress-po-mo', ['wordpress-po'], function() {
	return gulp.src('languages/en_EN.po')
		.pipe(gettext())
		.pipe(gulp.dest('languages'));
});

gulp.task('wordpress-lang', (['wordpress-pot', 'wordpress-po-mo']));
