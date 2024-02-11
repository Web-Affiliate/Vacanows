const Encore = require('@symfony/webpack-encore');

// Configure the runtime environment if not already configured by the "encore" command.
if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')

    .addEntry('app', './assets/app.js')
    .splitEntryChunks()
    .enableSingleRuntimeChunk()

    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())

    .configureBabelPresetEnv((config) => {
        config.useBuiltIns = 'usage';
        config.corejs = '3.23';
    })

    // Enable Bootstrap
    .autoProvidejQuery()
    .addStyleEntry('bootstrap', './node_modules/bootstrap/dist/css/bootstrap.css') // Add this line

    .enableSassLoader() // Uncomment if you use Sass/SCSS

    // Other features...
    // .enableTypeScriptLoader()
    // .enableReactPreset()
    // .enableIntegrityHashes(Encore.isProduction())
    // .autoProvidejQuery()

    // Configure other features as needed

;

module.exports = Encore.getWebpackConfig();
