module.exports = {
    entry: ['./resources/index.js'],
    module: {
        rules: [
            {
                test: /\.(js|jsx)$/,
                exclude: /node_modules/,
                use: ['babel-loader']
            }
        ]
    },
    resolve: {
        extensions: ['*', '.js', '.jsx']
    },
    output: {
        path: __dirname + '/public/js',
        publicPath: '/',
        filename: 'bundle.js'
    },
    devServer: {
        contentBase: './public/js'
    }
};
