import createStore from '../Store';

describe('Store', () => {

    let store;

    beforeEach(() => {
        store = createStore();
        store.initialize({
            collection: 'default',
            createUrl: 'http://blender.dev/blender/api/contentblocks',
            mediaUrl: 'http://blender.dev/blender/api/media',
            model: {
                name: '\\App\\Models\\Article',
                id: 1,
            },
        });
    });

    it('can be initialized', () => {
        expect(store.collection).toBe('default');
        expect(store.createUrl).toBe('http://blender.dev/blender/api/contentblocks');
        expect(store.mediaUrl).toBe('http://blender.dev/blender/api/media');
        expect(store.model).toEqual({ name: '\\App\\Models\\Article', id: 1 });
    });

    it('can add an array of existing blocks', () => {

        const block = {
            id: 1,
            title: 'Lego',
            layout: 'image-left',
        };

        store.addBlocks([block]);

        expect(store.blocks.length).toBe(1);
        expect(store.blocks[0]).toEqual(block);
    });

    it('can create a new block', async () => {
        
        await store.createBlock();

        expect(store.blocks.length).toBe(1);
    });
});