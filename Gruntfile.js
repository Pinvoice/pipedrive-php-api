// Gruntfile.js
module.exports = function(grunt) {
    grunt.initConfig({
        phpunit: {
            classes: {
                dir: 'tests'
            },
            options: {
                colors: true
            }
        },
        watch: {
            test: {
                files: ['src/**/*.*'],
                tasks: ['phpunit']
            }
        }
    });
 
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-phpunit');
    grunt.loadNpmTasks('grunt-notify');
};
