import createStore from '../lib/createStore';

describe('Store', () => {

    let store;

    beforeEach(() => {
        store = createStore();
        store.init({
            collection: 'default',
            createUrl: 'http://blender.dev/blender/api/contentblocks',
            mediaUrl: 'http://blender.dev/blender/api/media',
            model: {
                name: '\\App\\Models\\Article',
                id: 1,
            },
            data: {
                locales: ['nl', 'en'],
                contentLocale: 'nl',
            },
            initial: [],
        });
    });

    it('can be initialized', () => {
        expect(store.$data).toMatchSnapshot();
    });

    it('can add an array of existing blocks', () => {

        const block = {
            id: 1,
            title: 'Lego',
            layout: 'image-left',
        };

        store.addBlocks([block]);

        expect(store.blocks).toMatchSnapshot();
    });

    it('can create a new block', async () => {
        
        await store.createBlock();

        expect(store.blocks).toMatchSnapshot();
    });
});