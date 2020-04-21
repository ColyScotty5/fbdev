const sass = require('node-sass');

module.exports = function(grunt) {

  grunt.initConfig({
    jshint: {
      files: ['Gruntfile.js', 'js/**/*.js'],
      options: {
        globals: {
          jQuery: true
        }
      }
    },

    sass:{
      options: {
        implementation: sass,
        sourceMap: true
      },
      dist: {
        options: {
          outputStyle: 'compressed'
        },
        files: [
          {
            src: 'scss/above-fold.scss',
            dest: '../css/above-fold.css'
          },
          {
            src: 'scss/below-fold.scss',
            dest: '../css/below-fold.css'
          }
        ]
      }
    },

    uglify: {
      options: {
        mangle: false, 
        // compress: true
      },
      verbjs: {
        files: {
          '../js/main.min.js':
          [
            'vendor/swiper/js/swiper.min.js',
            // 'js/vendor/modernizr-custom.js',
            // 'js/vendor/slidebars.min.js',
            // 'js/vendor/slick/slick.min.js',
            // 'js/vendor/pickadate/picker.js',
            // 'js/vendor/pickadate/legacy.js',
            // 'js/vendor/pickadate/picker.date.js',
            // 'js/vendor/pickadate/picker.time.js',

            // Theme
            'js/custom.js'
          ]
        }
      }
    },

    postcss: {
      options: {
        processors: [
          require('autoprefixer') // add vendor prefixes
        ]
      },
      dist: {
        files: [
          {
            src: '../css/above-fold.css',
            dest: '../css/above-fold.css'
          },
          {
            src: '../css/below-fold.css',
            dest: '../css/below-fold.css'
          },
          {
            src: '../css/editor.css',
            dest: '../css/editor.css'
          }
        ]
      }
    },

    stylelint: {
      options: {
        configFile: '.stylelintrc',
        formatter: 'string',
        ignoreDisables: false,
        failOnError: true,
        reportNeedlessDisables: false
      },
      src: [
        'scss/**/*.scss',
        '!scss/vendor/**/*.scss'
      ]
    },

    watch: {
      styles: {
        files: [
          'scss/*.sass', 'scss/*.scss', 'scss/**/*.scss', 'js/*.js'
        ],
        tasks: ['uglify', 'sass', 'postcss', 'stylelint']
      }
    }
  });

  grunt.loadNpmTasks('grunt-sass');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-postcss');
  grunt.loadNpmTasks('grunt-stylelint');

  grunt.registerTask('build', ['sass' , 'postcss', 'stylelint', 'uglify']);
  grunt.registerTask('default', ['watch']);
  grunt.registerTask('js', ['uglify']);

};
