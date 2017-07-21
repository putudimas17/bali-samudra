var webpack = require('webpack');
const path = require('path');
var https = require('https');
var CopyWebpackPlugin = require('copy-webpack-plugin');
const ExtractTextPlugin = require("extract-text-webpack-plugin");
fs = require('fs');
const extractSass = new ExtractTextPlugin({
    filename: "[name].[contenthash].css",
    disable: process.env.NODE_ENV === "development"
});
var configuration = JSON.parse(
    fs.readFileSync('configuration.json')
);
//
// ini menentukan apakah project
// dalam status production atau development
// cara bikinnya di windows command promt ketil 'set NODE_ENV = "DEVELOPMENT" '
// process.env.NODE_ENV = "development";
// versi default process.env.NODE_ENV !== "production";
var debug = configuration.mode_option.debug !== false;
// console.log(debug);
// ---

var config = {
    context: __dirname + '/src', // `__dirname` is root of project and `src` is source
    entry: {
        app: './app.js',
        // admin: './admin.js'
    },
    output: {
        path: debug == true ?path.resolve(__dirname, './dist'):path.resolve(__dirname, './dist'), // `dist` is the destination
        filename: debug == true ? '[name].js' : '[name].[hash].js',
        chunkFilename: debug == true ?'[name].chunk.js':'[chunkhash].chunk.js',
        publicPath: debug == true ? configuration.DEBUG_URL : configuration.DIST_URL
    },
    devServer: {
        contentBase: path.resolve(__dirname, './src'), // `__dirname` is root of the project
    },
    module: {
        rules: [
            {
                test: /\.(js|jsx)?$/,
                include: path.resolve(__dirname, './src'),
                exclude: /(node_modules|bower_components)/,
                loader: 'babel-loader',
                query: {

                    //
                    // depedency buat compiler jsx 
                    // nya berfungsi
                    presets: [
                        'babel-preset-es2015',
                        'babel-preset-react',
                        'babel-preset-stage-0',
                    ].map(require.resolve),
                    // ---

                    //
                    // depedency buat compiler jsx 
                    // nya berfungsi
                    plugins: [
                        'babel-plugin-react-html-attrs',
                        'babel-plugin-transform-class-properties',
                        'babel-plugin-transform-decorators-legacy'
                    ].map(require.resolve),
                    // ---
                }
            },
            {
                test: /\.(tag)?$/,
                use: [
                    {
                        loader: "tag-loader"
                    }
                ],
                exclude: /(node_modules|bower_components)/,
            },
            {
                test: /\.(css|less|scss|sass)?$/,
                use: [{
                    loader: "style-loader" // creates style nodes from JS strings
                }, {
                    loader: "css-loader" // translates CSS into CommonJS
                }, {
                    loader: "sass-loader" // compiles Sass to CSS
                }]
            },
            {
                test: /\.html$/,
                loader: "html-loader"
            },
            { test: /\.jpe?g$|\.gif$|\.png$|\.svg$|\.woff$|\.woff2$|\.eot$|\.ttf$|\.wav$|\.mp3$/, loader: "file-loader?name=assets/[name].[ext]" }
        ]
    },
    plugins: [
        extractSass,
        new webpack.ProvidePlugin({
            $: "jquery",
            jQuery: "jquery"
        }),
        new webpack.optimize.CommonsChunkPlugin({
            name: 'vendor',
            minChunks: function (module) {
                // this assumes your vendor imports exist in the node_modules directory
                return module.context && module.context.indexOf('node_modules') !== -1;
            }
        }),
        new CopyWebpackPlugin([
            //{ from: 'css', to: 'css' },
            //{ from: 'ico', to: 'ico' },
            { from: 'img', to: 'img' },
            // { from: 'font-awesome', to: 'font-awesome' },
            { from: 'js', to: 'js' },
        ])
    ]
};

module.exports = config;