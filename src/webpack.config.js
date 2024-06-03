const webpack = require('webpack');
const path = require('path');

const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const DependencyExtractionWebpackPlugin = require( '@wordpress/dependency-extraction-webpack-plugin' );

module.exports = {
  entry: {
    main: './index.js',
    admin: './admin.js',
    'admin-frontend': './admin-frontend.js'
  },

  output: {
    path: path.resolve(__dirname, '..'),
    filename: 'js/[name].js',
    chunkFilename: 'js/[name].[chunkhash].bundle.js',
  },

  module: {
    rules: [
      {
        test: /\.css$/,
        use: [MiniCssExtractPlugin.loader, "css-loader", 'postcss-loader']
      },
      {
        test: /\.(png|svg|jpg|gif|webp|avif)$/,
        type: 'asset/resource',
        generator: {
            filename: 'img/[name].[ext]',
        },
      },
      {
        test: /\.(woff|woff2|eot|ttf|otf)$/,
        type: 'asset/resource',
        generator: {
            filename: 'fonts/[name].[ext]',
        },
      },
    ]
  },

  plugins: [
    new webpack.ProgressPlugin(), // display progress information while processing...
    new DependencyExtractionWebpackPlugin({ injectPolyfill: false }),
    new MiniCssExtractPlugin({
      filename: 'css/[name].css'
    })
  ],
}