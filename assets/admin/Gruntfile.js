'use strict';
module.exports = function(grunt) {

  grunt.initConfig({
    less: {
      dist: {
        files: {
          'css/main.min.css': [
          'plugins/bootstrap-select2/select2.css',
          'plugins/jquery-slider/css/jquery.sidr.light.css',
          'plugins/jquery-datatable/css/jquery.dataTables.csss',
          'plugins/boostrap-checkbox/css/bootstrap-checkbox.css',
          'plugins/datatables-responsive/css/datatables.responsive.css',
          'plugins/bootstrap-datepicker/css/datepicker.css',
          'plugins/bootstrap-timepicker/css/bootstrap-timepicker.css',
          'plugins/bootstrapv3/css/bootstrap.min.css',
          'plugins/bootstrapv3/css/bootstrap-theme.min.css',
          'css/*.css',
          'less/*.less',
          '!css/main.min.css',
          ]
        },
        options: {
          compress: false,
          // LESS source map
          // To enable, set sourceMap to true and update sourceMapRootpath based on your install
          sourceMap: true,
          sourceMapFilename: 'css/main.min.css.map',
          sourceMapRootpath: '/'
        }
      }

    },
    uglify: {
      dist: {
        files: {
          'js/scripts.min.js': [
            'plugins/jquery-1.8.3.min.js',
            'plugins/bootstrap/js/bootstrap.min.js',
            'plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js',
            'plugins/bootstrapv3/js/bootstrap.min.js',
            'plugins/breakpoints.js',
            'plugins/jquery-unveil/jquery.unveil.min.js',
            'plugins/jquery-slider/jquery.sidr.min.js',
            'plugins/jquery-slimscroll/jquery.slimscroll.min.js',
            'plugins/bootstrap-select2/select2.min.js',
            'plugins/jquery-datatable/js/jquery.dataTables.min.js',
            'plugins/jquery-datatable/extra/js/TableTools.min.js',
            'plugins/datatables-responsive/js/datatables.responsive.js',
            'plugins/datatables-responsive/js/lodash.min.js',
            'js/*.js',
            'plugins/bootstrap-datepicker/js/bootstrap-datepicker.js',
            'plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js',
            'plugins/bootstrapv3/js/popover.js',
            'plugins/jquery-inputmask/jquery.inputmask.min.js',
            'plugins/plugins/jquery-numberAnimate/jquery.animateNumbers.js',
          ]
        },

        options: {
          // JS source map: to enable, uncomment the lines below and update sourceMappingURL based on your install
          // sourceMap: 'assets/js/scripts.min.js.map',
          // sourceMappingURL: '/assets/js/scripts.min.js.map'
        }
      }
    },
    // version: {
    //   options: {
    //     file: 'lib/scripts.php',
    //     css: 'assets/css/main.min.css',
    //     cssHandle: 'roots_main',
    //     js: 'assets/js/scripts.min.js',
    //     jsHandle: 'roots_scripts'
    //   }
    // },
    watch: {
      less: {
        files: [
          'less/*.less',
          'js/*.js',
        ],
        //tasks: ['less', 'version']
        tasks: ['less','uglify']
      },
      livereload: {
        // Browser live reloading
        // https://github.com/gruntjs/grunt-contrib-watch#live-reloading
        options: {
          livereload: true
        },
        files: [
          'css/main.min.css',
          'js/scripts.min.js',
          '*.php'
        ]
      }
    },
    clean: {
      dist: [
        'css/main.min.css',
        'js/scripts.min.js'
      ]
    }
  });

  // Load tasks
  grunt.loadNpmTasks('grunt-contrib-clean');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-less');

  // Register tasks
  grunt.registerTask('default', [
    'clean',
    'less',
    'uglify',
    //'version'
  ]);
  grunt.registerTask('dev', [
    'watch'
  ]);

};