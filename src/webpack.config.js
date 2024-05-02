const webpack = require('webpack');
const path = require('path');

const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const DependencyExtractionWebpackPlugin = require( '@wordpress/dependency-extraction-webpack-plugin' );

module.exports = {
  // mode: 'production',
  // watch: true,
  // devtool: "source-map",

  entry: {
    main: './index.js',
    admin: './admin.js',
    'admin-frontend': './admin-frontend.js'
  },

  output: {
    path: path.resolve(__dirname, '..'),
    filename: 'js/[name].js',
    chunkFilename: 'js/[name].[chunkhash].bundle.js',
    //publicPath: '/',
  },

  module: {
    rules: [
      {
        test: /\.css$/,
        use: [MiniCssExtractPlugin.loader, "css-loader", 'postcss-loader']
      },
      {
        test: /\.(png|svg|jpg|gif)$/,
        type: 'asset/resource',
        generator: {
            filename: 'img/[name].[hash][ext]',
            //publicPath: ''
        },
      },
      {
        test: /\.(woff|woff2|eot|ttf|otf)$/,
        type: 'asset/resource',
        generator: {
            filename: 'fonts/[name].[hash][ext]',
            //publicPath: ''
        },
      },
    ]
  },

  plugins: [
    new webpack.ProgressPlugin(), // display progress information while processing...
    new DependencyExtractionWebpackPlugin({ injectPolyfill: false }),
    new MiniCssExtractPlugin({
      filename: 'css/[name].css'
    }),
    new webpack.DefinePlugin({
      // 'process.env.ASSET_PATH': JSON.stringify(ASSET_PATH),
      'some.var': 123,
    }),
  ],
}