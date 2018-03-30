const { mix } = require('laravel-mix');
/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some  build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */
mix.webpackConfig({
    output: { chunkFilename: 'chunks/[name].chunk.js', publicPath: '/' },
    resolve:{
        // cache: true,
        extensions: ['.js', '.vue', '.json'],
        alias: {
            'src': path.resolve(__dirname, './resources/assets/js'),
            'components': path.resolve(__dirname, './resources/assets/js/components'),
            'views': path.resolve(__dirname, './resources/assets/js/views'),
            'api': path.resolve(__dirname, './resources/assets/js/api'),
            'utils': path.resolve(__dirname, './resources/assets/js/utils'),
            'helps': path.resolve(__dirname, './resources/assets/js/helps'),
            'config': path.resolve(__dirname, './resources/assets/js/config'),
            'store': path.resolve(__dirname, './resources/assets/js/vuex'),
            'router': path.resolve(__dirname, './resources/assets/js/router'),
            'vendor': path.resolve(__dirname, './resources/assets/js/vendor')
        }
    },
    // plugins: [
	// 	new webpackPlugins.DllReferencePlugin({
	// 		context: path.resolve(__dirname, './dll'),
	// 		manifest: require("./vendor-manifest.json")
	// 	})
    // ]
}).js('resources/assets/js/home.js','public/js')
.extract(['vue','element-ui','axios','vuex','lodash','vue-count-to','jquery'])
   .sass('resources/assets/sass/home/home.scss','public/css');
