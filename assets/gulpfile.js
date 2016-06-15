var gulp = require('gulp');
var less = require('gulp-less');

gulp.task('build', function () {
	gulp.src([
		'test.less'
	])
	.pipe(less())
	.pipe(gulp.dest('.'));
	console.log("Successfully built.");
});