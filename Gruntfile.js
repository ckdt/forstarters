module.exports = function(grunt) {
	// Project configuration.
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		uglify: {
			build: {
				files: {
					'assets/js/scripts.min.js' : ['assets/js/plugins.js', 'assets/js/main.js']
				}
			}
		},
		less: {
			dev: {
				files: {
					'assets/css/style.css' : 'assets/less/style.less'
				}
			},
			build: {
				options: {
					yuicompress: true
				},
				files: {
					'assets/css/style.min.css': 'assets/less/style.less'
				}
			}
		},
		watch: {
			less: {
				files: ['assets/less/*'],
				tasks: 'less'
			},
			uglify: {
				files: ['assets/js/plugins.js', 'assets/js/main.js'],
				tasks: 'uglify'
			}
		}
	});

	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-less');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.registerTask('default', ['less', 'uglify', 'watch']);
	grunt.registerTask('build', ['uglify', 'less']);
};