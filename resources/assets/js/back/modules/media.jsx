import media from 'blender-media';
import Name from 'blender-media/lib/Components/RowEditors/Name';
import React from 'react';

media.register('images', {
    acceptedFiles: 'images',
    rowEditor: <Name />,
});

media.register('downloads', {
    rowEditor: <Name />,
});

media.mount();
