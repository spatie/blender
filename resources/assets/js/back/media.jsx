import media from 'blender-media'
import React from 'react'

media.register('images', {
    acceptedFiles: 'images'
})

media.register('downloads')

media.mount()
