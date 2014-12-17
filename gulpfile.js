/*
 * Gulpfile to enable automated testing with PHPUnit.
 */
var _ = require('lodash');
var gulp = require('gulp');
var notify = require('gulp-notify');
var phpunit = require('gulp-phpunit');

var phpunit_location = '/usr/local/bin/phpunit';

/*
 * PHPUnit task.
 */
gulp.task('phpunit', function() {
    gulp.src('phpunit.xml')
        .pipe(phpunit(phpunit_location, { notify: true }))
        .on('error', notify.onError(testNotification('fail', 'phpunit')))
        .pipe(notify(testNotification('pass', 'phpunit')));
});

/*
 * Registers PHP files (anything in the 'app' folder) to watch for PHPUnit.
 */
gulp.task('watch', function() {
    gulp.watch('src/**/*.php', ['phpunit'])
})

/*
 * The default actions when the 'gulp' command runs.
 */
gulp.task('default', ['phpunit', 'watch'])





// Function to display pretty notifications.
function testNotification(status, pluginName, override) {
    var options = {
        title:   ( status == 'pass' ) ? 'Hooray!' : 'Aww...',
        message: ( status == 'pass' ) ? '\n\nAll tests have passed.\n\n' : '\n\nOne or more tests failed.\n\n',
        icon:    __dirname + '/node_modules/gulp-' + pluginName +'/assets/test-' + status + '.png'
    };
    options = _.merge(options, override);
    return options;
}
