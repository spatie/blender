module.exports = {
    plugins: [
        require('postcss-easy-import')(),
        require('tailwindcss')('./tailwind.js'), 
        require('postcss-cssnext')({
            features: {
                // Mix takes care of this.
                autoprefixer: false,
            },
        }),
    ],
};
