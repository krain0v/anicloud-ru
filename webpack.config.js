const path = require('path');

module.exports = {
    mode: "production",
    entry: "./src/animelib/assets/javascripts/index.coffee",
    output: {
        path: path.resolve(__dirname, "dist"),
        filename: "bundle.js",
        publicPath: "/dist/",
    },
    module: {
        rules: [
            {
                test: /\.coffee$/,
                loader: 'coffee-loader',
            },
            {
                test: /\.s[ac]ss$/i,
                use: [
                    // Creates `style` nodes from JS strings
                    "style-loader",
                    // Translates CSS into CommonJS
                    "css-loader",
                    // Compiles Sass to CSS
                    "sass-loader",
                ],
            },
        ],
    },
};