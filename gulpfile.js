
var gulp = require('gulp');
var sass = require('gulp-sass');
var watch = require("gulp-watch");
var sourcemaps = require('gulp-sourcemaps');

gulp.task('sass', function()
{
	gulp.src('./scss/style.scss')
		.pipe(sourcemaps.init())
		.pipe(sass())
		.pipe(sourcemaps.write())
		.pipe(gulp.dest('./css/'));
});

gulp.task('watch', function()
{
	watch(['./scss/**'], function()
	{
		gulp.start('sass');
	});
});

gulp.task('default', ['sass']);