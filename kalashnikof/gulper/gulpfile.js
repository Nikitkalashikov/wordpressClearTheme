var syntax = 'scss',
	gulpversion = '4';

var gulp = require('gulp'),
	autoprefixer = require('gulp-autoprefixer'),
	concat = require('gulp-concat'),
	cleancss = require('gulp-clean-css'),
	imagemin = require('gulp-imagemin'),
	rename = require('gulp-rename'),
	sass = require('gulp-sass'),
	uglify = require('gulp-uglify');

// Обьединяем файлы sass, сжимаем и переменовываем
gulp.task('styles', function () {
	// return gulp.src('../app/scss/**/*.scss')
	return gulp.src([
		'../app/scss/reset.scss',
		'../app/lib/fancybox.css',
		'../app/scss/styles.scss',
		'../app/scss/media.scss'
	])
		.pipe(sass({ outputStyle: 'expand' }).on("error", notify.onError()))
		.pipe(rename({ suffix: '.min', prefix: '' }))
		.pipe(concat('styles.min.css'))
		.pipe(autoprefixer(['last 15 versions']))
		.pipe(cleancss({ level: { 1: { specialComments: 0 } } })) // Opt., comment out when debugging
		.pipe(gulp.dest('../dist/css'))
});

// Обьединяем файлы скриптов, сжимаем и переменовываем
gulp.task('scripts', function () {
	return gulp.src([
		'../app/js/fancybox.min.js',
		'../app/js/inputmask.min.js',
		'../app/js/scripts.js',
	])
		.pipe(concat('scripts.min.js'))
		.pipe(uglify()) // Mifify js (opt.)
		.pipe(gulp.dest('../dist/js'))
});

// сжимаем картинки в папке images в шаблоне, и туда же возвращаем в готовом виде
gulp.task('img', function () {
	return gulp.src('../app/img/**/*')
		.pipe(cache(imagemin())) // Cache Images
		.pipe(gulp.dest('../dist/img'));
});

// сжимаем картинки в папке uploads, и туда же возвращаем в готовом виде
gulp.task('imgmin-uploads', function () {
	return gulp.src('../../../wp-content/uploads/**/*')
		.pipe(cache(imagemin())) // Cache Images
		.pipe(gulp.dest('../../../wp-content/uploads'));
});