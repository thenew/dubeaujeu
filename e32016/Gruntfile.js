var assets_path = 'wp-content/themes/radiokawa/library';

module.exports = function(grunt) {

    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-autoprefixer');

    grunt.initConfig({
        sass: {
            dist: {
                options:{
                    style:'compressed'
                },
                files: {
                    'styles.css': 'styles.scss'
                }
            }
        },
        autoprefixer:{
            options: {
                map: true,
                browsers: ['last 2 versions', 'ie 9']
            },
            dist:{
                files: {
                    'styles.css': 'styles.scss'
                }
            }
        },
        watch: {
            css: {
                files: 'styles.scss',
                tasks: ['styles']
            }
        }

    });

    grunt.registerTask('styles', ['sass']);
}

// Tâches disponibles :

// - pour le dev, surveille et lance les tâche styles et scripts dès que nécessaire
// $ grunt watch

// - pour générer le CSS depuis le sass
// $ grunt styles

// - pour générer le JS
// $ grunt scripts
