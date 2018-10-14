module.exports = {
    baseUrl: 'dist',
    outputDir: 'public/dist',
    configureWebpack: {
        resolve: {
            alias: {
                '@': __dirname + '/client'
            }
        },
        entry: {
            app: './client/main.js'
        },
        devServer: {
            baseUrl: '/',
            contentBase: './client'
        }
    }
};
