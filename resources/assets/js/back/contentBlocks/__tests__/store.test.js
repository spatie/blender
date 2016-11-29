import createStore from '../lib/createStore';

describe('Store', () => {

    let store;

    beforeEach(() => {
        store = createStore();
        store.init({
            collection: 'default',
            createUrl: 'http://blender.dev/blender/api/contentblocks',
            model: {
                name: 'App\\Models\\Article',
                id: 1,
            },
            data: {
                mediaUrl: 'http://blender.dev/blender/api/media',
                mediaModel: 'App\\Models\\ContentBlock',
                locales: ['nl', 'en'],
                contentLocale: 'nl',
            },
            initial: [],
        });
    });

    it('can be initialized', () => {
        expect(store.collection).toEqual('default');
        expect(store.createUrl).toEqual('http://blender.dev/blender/api/contentblocks');
        expect(store.model).toEqual({ name: 'App\\Models\\Article', id: 1 });
        expect(store.data.mediaUrl).toEqual('http://blender.dev/blender/api/media');
        expect(store.data.mediaModel).toEqual('App\\Models\\ContentBlock');
        expect(store.data.locales).toEqual(['nl', 'en']);
        expect(store.data.contentLocale).toEqual('nl');
        expect(store.blocks).toEqual([]);
    });

    it('can add an array of existing blocks', () => {

        const block = {
            id: 1,
            title: 'Lego',
            layout: 'image-left',
        };

        store.addBlocks([block]);

        expect(store.blocks).toEqual([{ ...block, ...{ markedForRemoval: false } }]);
    });

    it('can create a new block', async () => {
        
        await store.createBlock();

        expect(store.blocks.length).toEqual(1);
    });
});