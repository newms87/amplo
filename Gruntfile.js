module.exports = function(grunt) {
	grunt.initConfig({
		pkg:      grunt.file.readJSON('package.json'),
		uglify:   {
			options: {
				banner:    '/*! <%= pkg.name %> <%= grunt.template.today("yyyy-mm-dd") %> */\n',
				report:    'min',
				sourceMap: true
			},
			build:   {
				files: [
					{'public/js/app.js': ['resources/assets/js/app.js']},
				]
			},
			appthis: {
				files: [
					{'public/js/appthis.js': ['resources/assets/js/appthis.js', 'resources/assets/js/pickaday.js']},
				]
			}
		},
		sass:     {
			options: {
				style: 'expanded'
			},
			dist:    {
				files: [{
					expand: true,
					cwd:    'resources/assets/sass/',
					src:    ['*.scss'],
					dest:   'public/css/',
					ext:    '.css'
				}]
			}
		},
		cssmin:   {
			options: {
				report:    'min',
				sourceMap: true
			},
			target:  {
				files: [{
					expand: true,
					cwd:    'public/css',
					src:    ['**'],
					dest:   'public/css',
					ext:    '.min.css'
				}]
			}
		},
		watch:    {
			styles:  {
				files:   ['resources/assets/sass/**/*.scss'],
				tasks:   ['sass'],
				options: {
					spawn: false,
				},
			},
			scripts: {
				files:   ['resources/assets/js/**/*.js'],
				tasks:   ['uglify'],
				options: {
					spawn: false,
				},
			},
		}
	});

	grunt.loadNpmTasks('grunt-changed');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-contrib-watch');

	grunt.registerTask('css', ['changed:sass', 'changed:cssmin']);
	grunt.registerTask('compile', ['uglify', 'sass', 'cssmin']);
	grunt.registerTask('default', ['changed:uglify', 'changed:sass', 'changed:cssmin']);

	grunt.registerTask('appthis', ['changed:uglify:appthis', 'changed:sass', 'changed:cssmin']);
};
