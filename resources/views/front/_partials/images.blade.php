@php
$collectionName = $collectionName ?? 'images';
$profile = $profile ?? 'thumb';
@endphp

@foreach($item->getMedia($collectionName) as $image)
    <a href="{{ $image->getUrl() }}">
        <img src="{{ $image->getUrl($profile) }}"/>
    </a>
@endforeach
