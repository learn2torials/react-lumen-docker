const path = require('path');

module.exports = {
    watch: true,
    entry: './src/index.js',
    output: {
        publicPath: '/',
        filename: 'bundle.js',
        path: __dirname + '/../public/js/'
    },
    module: {
        rules: [
            {
                test: /\.(js)$/,
                use: ['babel-loader'],
                exclude: /node_modules/
            }
        ]
    },
    devServer: {
        port: 8000,
        compress: true,
        host: '0.0.0.0',
        disableHostCheck: true,
        historyApiFallback: true,
        contentBase: path.join(__dirname, 'dist'),
        proxy: {
            '/': 'http://localhost:8080'
        }
    },
};
