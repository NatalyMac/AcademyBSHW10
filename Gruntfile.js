module.exports = function(grunt) {

    grunt.loadNpmTasks('grunt-concat-css');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-browserify');
    grunt.loadNpmTasks('grunt-contrib-cssmin');

    grunt.registerTask('dev', ['browserify','concat_css:all', 'concat:all','watch']);
    grunt.registerTask('stage', ['browserify','concat_css:all', 'concat:all']);
    grunt.registerTask('prod', ['browserify','concat_css:all', 'concat:all','uglify','cssmin']);

    grunt.initConfig({

        pkg: grunt.file.readJSON('package.json'),

        browserify: {
            main: {
                src: 'resources/assets/js/app/*.js',
                dest: 'public/js/bundle.js'
            }
        },

        watch: {
            files: 'resources/assets/js/app/*',
            tasks: ['default']
        },

        concat_css: {
            all: {
                src: ["resources/assets/css/*.css"],
                dest: "public/css/style.css"
            }
        },

        concat: {
            options: {
                separator: '<!------------------------------------------------>'
            },
            all: {
                src: ["resources/assets/js/template/*.tpl"],
                dest: "public/resources/home.blade.php"
            }
        },
        
        uglify: {
            options: {
                mangle: false
            },
            my_target: {
                files: {
                    'public/js/bundle.js':['public/js/bundle.js']
                }
            }
        },

        cssmin: {
            options: {
                shorthandCompacting: false,
                roundingPrecision: -1
            },
            target: {
                files: {
                    'public/css/style.css': ['public/css/style.css']
                }
            }
        }
    })
};
