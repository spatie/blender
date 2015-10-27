import media from 'blender-media'
import React from 'react'

import Columns from 'blender-media/lib/Components/RowEditors/Layout/Columns'
import Locales from 'blender-media/lib/Components/Fields/Locales'
import Name from 'blender-media/lib/Components/Fields/Name'
import RowEditor from 'blender-media/lib/Components/RowEditors/Layout/RowEditor'
import Select from 'blender-media/lib/Components/Fields/Select'

let chooserOptions = [
    { label: 'Foo', value: 1 },
    { label: 'Bar', value: 2 },
    { label: 'Baz', value: 3 },
    { label: 'Baz', value: 4 },
    { label: 'Baz', value: 5 },
    { label: 'Baz', value: 6 },
    { label: 'Baz', value: 7 },
    { label: 'Baz', value: 8 },
    { label: 'Baz', value: 9 },
    { label: 'Baz', value: 10 },
    { label: 'Baz', value: 11 },
    { label: 'Baz', value: 12 },
    { label: 'Cux', value: 13 }
]

const Chooser = () => {
    return (
        <RowEditor>
            <Columns size="4">
                <Name />
            </Columns>
            <Columns size="4">
                <Select for="foo" options={chooserOptions} default={2} />
            </Columns>
            <Columns size="4" align="right">
                <Locales />
            </Columns>
        </RowEditor>
    )
}

media.debug = true

media.register('images', {
    acceptedFiles: 'images',
    rowEditor: <Chooser />
})

media.register('downloads')

media.mount()
