@php
$collectionName = $collectionName ?? 'images';
$imageProfile = $imageProfile ?? 'thumb';
@endphp

@foreach($item->getMedia($collectionName) as $image)
    <a href="{{ $image->getUrl() }}">
        <img src="{{ $image->getUrl($imageProfile) }}"/>
    </a>
@endforeach
