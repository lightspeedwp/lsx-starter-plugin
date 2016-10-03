var gulp = require('gulp');

gulp.task('default', function() {	 
	console.log('Use the following commands');
	console.log('--------------------------');
	console.log('gulp sass           to compile the style.scss to style.css');
	console.log('gulp admin-sass     to compile the admin.scss to admin.css');
	console.log('gulp compile-sass   to compile both of the above.');
	console.log('gulp js             to compile the custom.js to custom.min.js');
	console.log('gulp compile-js     to compile both of the above.');
	console.log('gulp watch          to continue watching all files for changes, and build when changed');
	console.log('gulp wordpress-pot  to compile the {plugin-name}.pot');
});

var sass = require('gulp-sass');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var sort = require('gulp-sort');
var wppot = require('gulp-wp-pot');

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
	.pipe(concat('{plugin-name}.min.js'))
	.pipe(uglify())
	.pipe(gulp.dest('assets/js'));
});

gulp.task('admin-js', function () {
	gulp.src('assets/js/{plugin-name}-admin.js')
	.pipe(concat('{plugin-name}-admin.min.js'))
	.pipe(uglify())
	.pipe(gulp.dest('assets/js'));
});
 
gulp.task('compile-sass', (['sass', 'admin-sass']));
gulp.task('compile-js', (['js', 'admin-js']));

gulp.task('watch', function() {
	gulp.watch('assets/css/{plugin-name}.scss', ['sass']);
	gulp.watch('assets/css/{plugin-name}-admin.scss', ['admin-sass']);
	gulp.watch('assets/js/{plugin-name}.js', ['js']);
	gulp.watch('assets/js/{plugin-name}-admin.js', ['admin-js']);
});

gulp.task('wordpress-lang', function () {
	return gulp.src('**/*.php')
		.pipe(sort())
		.pipe(wppot({
			domain: '{plugin-name}',
			destFile: '{plugin-name}.pot',
			package: '{plugin-name}',
			bugReport: '{plugin-url}/issues',
			team: '{your-name} <{your-email}>'
		}))
		.pipe(gulp.dest('languages'));
});
