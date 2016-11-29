function createBlock() {
    return new Promise(resolve => resolve({
        id: 1,
        title: 'Lego',
        layout: 'image-left',
    }));
}

function unknownUrl(url) {
    return new Promise(
        (resolve, reject) => reject(`Unknown URL: ${url}`)
    );
}

module.exports = {
    post(url) {
        switch (url) {
            case 'http://blender.dev/blender/api/contentblocks':
                return createBlock();
            default:
                return unknownUrl(url);
        }
    },
};