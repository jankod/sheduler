var Encore = require('@symfony/webpack-encore');


Encore
// the project directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // the public path used by the web server to access the previous directory
    .setPublicPath('/build')

    .autoProvideVariables({Popper: ['popper.js', 'default']})


    // will create public/build/app.js and public/build/app.css
    .addEntry('app', './assets/js/app.js')

    // allow sass/scss files to be processed
    .enableSassLoader(function (sassOptions) {
        sassOptions.resolveUrlLoader = true;
    })

    // allow legacy applications to use $/jQuery as a global variable
    .autoProvidejQuery()

    // show OS notifications when builds finish/fail
    .enableBuildNotifications()

    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
// uncomment to create hashed filenames (e.g. app.abc123.css)
// .enableVersioning(Encore.isProduction())

// uncomment to define the assets of the project
// .addEntry('js/app', './assets/js/app.js')
// .addStyleEntry('css/app', './assets/css/app.scss')


;

module.exports = Encore.getWebpackConfig();

module.exports.resolve =
    { // peace radi probleme
        alias: {
            pace: 'pace-progress'
        }
    }